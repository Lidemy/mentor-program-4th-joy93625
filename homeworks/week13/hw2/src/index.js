import { getComments, addComments } from './api'
import { appendCommentToDom, appendStyle } from './utils'
import { cssTemplate, getLoadMoreButton, getForm} from './template'
import $ from 'jquery'



export function init(options) {
    let siteKey = ''
    let apiUrl = ''
    let containerElement = null
    let commentDOM = null
    let lastId = null
    let isEnd = false
    let loadMoreClassName
    let commentsClassName
    let commentsSelector
    let formClassName
    let formSelector

    siteKey = options.siteKey
    apiUrl = options.apiUrl
    loadMoreClassName = `${siteKey}-load-more`
    commentsClassName = `${siteKey}-comments`
    formClassName = `${siteKey}-add-comment-form`
    formSelector = '.' + formClassName
    commentsSelector = '.' + commentsClassName

    containerElement = $(options.containerSelector)
    containerElement.append(getForm(formClassName, commentsClassName))

    appendStyle(cssTemplate)

    commentDOM = $(commentsSelector)
    getNewComments()

    $(commentsSelector).on('click', '.' + loadMoreClassName, () => {
        getNewComments()
    })
    $(formSelector).submit(e => {
        e.preventDefault();
        const nickNameDOM = $(`${formSelector} input[name=nickname]`)
        const contentDOM = $(`${formSelector} textarea[name=content]`)
        const newCommentData = {
            site_key: siteKey,
            nickname: nickNameDOM.val(),
            content: contentDOM.val(),
        }
    addComments(apiUrl, siteKey, newCommentData, data => {
        if (!data.ok) {
            alert(data.message)
            return
        }
        nickNameDOM.val('')
        contentDOM.val('')
        appendCommentToDom(commentDOM, newCommentData, true)
      })
    })
    function getNewComments () {
        const commentDOM = $(commentsSelector)
        $('.' + loadMoreClassName).hide()
        if (isEnd) {
            return
        }
        getComments(apiUrl, siteKey, lastId, data => {
            if (!data.ok) {
                alert(data.message)
                return
            }
            const comments = data.discussions;
            for (let comment of comments) {
                appendCommentToDom(commentDOM, comment)
            }
            let length = comments.length
            if (length === 0) {
                isEnd = true
                $('.' + loadMoreClassName).hide()
            } else {
                lastId = comments[length - 1].id
                const loadMoreButtonHTML = getLoadMoreButton(loadMoreClassName)
                $(commentsSelector).append(loadMoreButtonHTML)
            }
        })
    }
    
}

