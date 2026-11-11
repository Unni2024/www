/* Shared by the WordPress scripts and React; no authenticated requests before this resolves. */
;(function (window, $) {
  let pending = null
  let state = 'idle'
  let failure = null

  window.ppSiteConnection = {
    get state() { return state },
    connect(force = false) {
      if (pending) return pending
      if (state === 'failed' && !force) return Promise.reject(failure)

      const settings = window.parcelpanel_param
      const token = window.ppCommonData?.token
      if (!force && token && (state === 'ready' || settings?.site_status?.is_connected)) {
        state = 'ready'
        return Promise.resolve(token)
      }
      if (!settings?.connect_server_nonce || !window.ajaxurl) {
        state = 'failed'
        failure = new Error('Unable to connect the store. Please refresh the page and try again.')
        return Promise.reject(failure)
      }

      state = 'connecting'
      pending = new Promise((resolve, reject) => {
        let settled = false
        $.ajax({
          url: window.ajaxurl,
          method: 'POST',
          dataType: 'json',
          timeout: 20000,
          data: { action: 'pp_connect', _ajax_nonce: settings.connect_server_nonce },
        }).done((res) => {
          if (settled) return
          settled = true
          // Never treat the page's old/generated token as a newly verified credential.
          // Legacy PHP is recovered separately by React with a guarded reload.
          const newToken = res?.data?.token
          if (!res?.success || !res?.data?.is_connected || typeof newToken !== 'string' || !newToken.trim()) {
            reject(new Error(res?.msg || 'Unable to connect the store. Please try again.'))
            return
          }
          window.ppCommonData = window.ppCommonData || {}
          window.ppCommonData.token = newToken
          settings.site_status.is_connected = true
          resolve(newToken)
        }).fail((_xhr, status) => {
          if (settled) return
          settled = true
          reject(new Error(status === 'timeout'
            ? 'Connection timed out. Please try again.'
            : 'Unable to connect the store. Please try again.'))
        })
      }).then((newToken) => {
        state = 'ready'
        failure = null
        pending = null
        return newToken
      }, (error) => {
        state = 'failed'
        failure = error
        pending = null
        throw error
      })
      return pending
    },
  }
})(window, jQuery)
