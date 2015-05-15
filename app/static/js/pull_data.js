/**
 * Created by root on 4/15/15.
 */

var eventCallBack, getter, filler, poster;
var utility;
var user_api_key = null;

var asyncCaller = [];

var index_channels = {
    id: {},
    counts: {},
    lastIDs: {}
};
var last_comment_id = 0;
var last_channel_news_id = 0;

var MAX_SLIDER_ITEMS = 5;
var MAX_SIDE_NEWS_ITEMS = 5;
var MAX_INDEX_CHANNEL_NEWS_ITEMS = 8;
var MAX_NEWS_ITEM_PER_REQUEST = 20;

var current_page;
var PAGE = {
    index: 1,
    login: 2,
    channels: 3,
    all_channels: 4,
    news: 5,
    category: 6,
    admin_home: 7,
    admin_login: 8,
    user_register: 9,
    channel_register: 10
};

var CALLER_INDEX = {
    categories: 1,
    news: 2,
    comment: 3,
    all_channels: 4,
    category_news: 5,
    login: 6,
    channel: 7,
    channel_news: 8,
    subscriptions: 9,
    user_news_feed: 10,
    user_news_feed_with_marker: 11,
    all_news: 12,
    all_news_with_marker: 13,
    admin_home: 14,
    admin_login: 15,
    admin_add_news: 16,
    admin_edit_profile: 17,
    subscribe: 18,
    unsubscribe: 19,
    like: 20,
    dislike: 21,
    user_register: 22,
    channel_register: 23,
    add_comment: 24,
    trending_news: 25,
    delete_news: 26
};

var KEY = {
    standard: "5cd84de2d3c90164b343708e701963e8",
    admin: "3aa2a3173c895a4618a15e4960bed678"
};

var BASE_URL = "http://webo.oauife.edu.ng/gist/api";

var URL = {
    login: BASE_URL + "/users/login?key=" + KEY.standard,
    admin_login: BASE_URL + "/channels/login?key=" + KEY.standard,
    local_login_file: "http://localhost/web/login/verify",
    user_register: BASE_URL + "/users/register?key=" + KEY.standard,
    channel_register: BASE_URL + "/channels/create?key=" + KEY.standard,
    news: BASE_URL + "/news/news_by_id/_ID?key=" + KEY.standard,
    news_by_category: BASE_URL + "/news/category/_ID?key=" + KEY.standard,
    news_by_category_with_marker: BASE_URL + "/news/category/_ID?marker=_LAST&type=_TYPE&key=" + KEY.standard,
    categories: BASE_URL + "/categories?key=" + KEY.standard,
    news_by_channel: BASE_URL + "/news/channels/_ID?key=" + KEY.standard,
    news_by_channel_with_marker: BASE_URL + "/news/channels/_ID?marker=_LAST&type=_TYPE&key=" + KEY.standard,
    news_feed: BASE_URL + "/news_feed?key=_API_KEY",
    news_feed_with_marker: BASE_URL + "/news_feed?marker=_LAST_ID&type=_TYPE&key=_API_KEY",
    all_news: BASE_URL + "/news?key=" + KEY.standard,
    all_news_with_marker: BASE_URL + "/news?marker=_LAST_ID&type=_TYPE&key=" + KEY.standard,
    channel_details: BASE_URL + "/channels/_ID?key=" + KEY.standard,
    trending_news: BASE_URL + "/news/trending?key=" + KEY.standard,
    admin_add_news: BASE_URL + "/news/add?key=" + KEY.standard,
    admin_edit_profile: BASE_URL + "/channels/edit_profile?key=" + KEY.standard,
    comments: BASE_URL + "/comments/_ID?key=" + KEY.standard,
    all_channels: BASE_URL + "/channels?key=" + KEY.standard,
    my_subscriptions: BASE_URL + "/subscriptions?key=" + KEY.standard,
    subscribe: BASE_URL + "/subscriptions/add?key=" + KEY.standard,
    unSubscribe: BASE_URL + "/subscriptions/remove?key=" + KEY.standard,
    like: BASE_URL + "/like?key=" + KEY.standard,
    dislike: BASE_URL + "/dislike?key=" + KEY.standard,
    add_comment: BASE_URL + "/comments/add?key=" + KEY.standard,
    delete_news: BASE_URL + "/news/delete?key=" + KEY.standard
};

var DEFAULT_IMG_URL = {
    user: 'http://webo.oauife.edu.ng/gist/api/uploads/news/user_default.png',
    news: 'http://webo.oauife.edu.ng/gist/api/uploads/news/news_default.png',
    channel: 'http://webo.oauife.edu.ng/gist/api/uploads/news/channel_default.png'
};

var EventCallBack = function(){};

function login(){
    var obj = asyncCaller[CALLER_INDEX.login].responseObj["feedback"];

    if (obj["logged_in"]){
        var magic_div = document.getElementById('magic_div');
        magic_div.innerHTML = '<form id="magic_form" method="POST" action="' + utility.getUrlFor("login/verify") + '">' +
        '<input class="hidden" type="text" name="user_id" value="' + obj["user_id"] + '">' +
        '<input class="hidden" type="text" name="user_api_key" value="' + obj["api_key"] + '">' +
        '</form>';
        var form = document.getElementById('magic_form');
        if (form)
            form.submit();
    }
    else{
        var error_div = document.getElementById('error_div');
        error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
    }

}

function adminLogin(){
    var obj = asyncCaller[CALLER_INDEX.admin_login].responseObj["feedback"];

    if (obj["logged_in"]){
        console.log("Logging in");
        var magic_div = document.getElementById('magic_div');
        magic_div.innerHTML = '<form id="magic_form" method="POST" action="' + utility.getUrlFor("admin/verify") + '">' +
        '<input class="hidden" type="text" name="channel_id" value="' + obj["channel_id"] + '">' +
        '</form>';
        var form = document.getElementById('magic_form');
        if (form)
            form.submit();
    }
    else{
        var error_div = document.getElementById('error_div');
        error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
    }

}

function editChannelProfile(){

}

function removePreviousComment(){
    var comment_section = document.getElementById('ccr-commnet');
    var nextSibling = comment_section.firstElementChild.nextElementSibling;
    while(nextSibling){
        var new_sibling = nextSibling.nextElementSibling;
        nextSibling.remove();
        nextSibling = new_sibling;
    }
}

function likeNewsItem(news_id){
    var obj = asyncCaller[CALLER_INDEX.like].responseObj;

    if (obj && obj["info"]["error_code"] == 200){
        var like_btn = document.getElementById('news_like_btn');
        like_btn.firstElementChild.innerText++;
        like_btn.disabled = true;

        var dislike_btn = document.getElementById('news_dislike_btn');
        if (dislike_btn.disabled){
            dislike_btn.firstElementChild.innerText--;
            dislike_btn.disabled = false;
        }
        //removePreviousComment();
        //getter.getNews(news_id)
    }
    else{
        //var error_div = document.getElementById('error_div');
        //error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
    }
}

function dislikeNewsItem(news_id){
    var obj = asyncCaller[CALLER_INDEX.dislike].responseObj;

    if (obj && obj["info"]["error_code"] == 200){
        var dislike_btn = document.getElementById('news_dislike_btn');
        dislike_btn.firstElementChild.innerText++;
        dislike_btn.disabled = true;

        var like_btn = document.getElementById('news_like_btn');
        if (like_btn.disabled){
            like_btn.firstElementChild.innerText--;
            like_btn.disabled = false;
        }
        //removePreviousComment();
        //getter.getNews(news_id);
    }
    else{
        //var error_div = document.getElementById('error_div');
        //error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
    }
}

function commentOnNewsItem(news_id){
    var obj = asyncCaller[CALLER_INDEX.comment].responseObj;

    if (obj && obj["info"]["error_code"] == 200){
        //removePreviousComment();
        getter.getNews(news_id);
        //getter.getComment(news_id);


    }
    else{
        var error_div = document.getElementById('error_div');
        error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
    }
}

function subscribeToChannel(channel_id){
    var obj = asyncCaller[CALLER_INDEX.subscribe].responseObj;

    if (obj && obj["info"]["error_code"] == 200){
        var btn = document.getElementById('action_btn_' + channel_id).firstElementChild;

        var btn_class = 'danger';
        var btn_label = 'UNSUBSCRIBE';
        var btn_onclick = function(){
            var channel_id = this.getAttribute('id');
            if (channel_id){
                channel_id = parseInt(channel_id.replace("action_btn_", ""));
                poster.unSubscribeFromChannel(channel_id);
            }
        };

        btn.setAttribute('class', 'btn btn-' + btn_class + ' pull-right');
        btn.innerHTML = btn.innerHTML.replace('SUBSCRIBE', btn_label);
        btn.parentElement.onclick = btn_onclick;
        var last_element = btn.lastElementChild;
        if (last_element){
            last_element.innerText = (parseInt(last_element.innerText) + 1) + "";
        }


    }
    else{
        var error_div = document.getElementById('error_div');
        error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
    }
}

function unSubscribeFromChannel(channel_id){
    var obj = asyncCaller[CALLER_INDEX.unsubscribe].responseObj;

    if (obj && obj["info"]["error_code"] == 200){
        var btn = document.getElementById('action_btn_' + channel_id).firstElementChild;

        var btn_class = 'success';
        var btn_label = 'SUBSCRIBE';
        var btn_onclick = function(){
            var channel_id = this.getAttribute('id');
            if (channel_id){
                channel_id = parseInt(channel_id.replace("action_btn_", ""));
                poster.subscribeToChannel(channel_id);
            }
        };


        btn.setAttribute('class', 'btn btn-' + btn_class + ' pull-right');
        btn.innerHTML = btn.innerHTML.replace('UNSUBSCRIBE', btn_label);
        btn.parentElement.onclick = btn_onclick;
        var last_element = btn.lastElementChild;
        if (last_element)
            last_element.innerText = (parseInt(last_element.innerText) - 1) + "";

    }
    else{
        var error_div = document.getElementById('error_div');
        error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
    }
}

function registerUser(){
    var obj = asyncCaller[CALLER_INDEX.user_register].responseObj;

    if (obj["info"]["error_code"] == 201){
        var magic_div = document.getElementById('magic_div');
        magic_div.innerHTML = '<form id="magic_form" method="POST" action="' + utility.getUrlFor("login/verify") + '">' +
        '<input class="hidden" type="text" name="user_id" value="' + obj["feedback"]["user_id"] + '">' +
        '<input class="hidden" type="text" name="user_api_key" value="' + obj["feedback"]["api_key"] + '">' +
        '</form>';
        var form = document.getElementById('magic_form');
        if (form)
            form.submit();
    }
    else{
        var error_div = document.getElementById('error_div');
        error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
        error_div.firstElementChild.innerHTML = obj["info"]["message"];
    }
}

function registerChannel(){
    var obj = asyncCaller[CALLER_INDEX.channel_register].responseObj;

    if (obj["info"]["error_code"] == 200){
        var magic_div = document.getElementById('magic_div');
        magic_div.innerHTML = '<form id="magic_form" method="POST" action="' + utility.getUrlFor("admin/verify") + '">' +
        '<input class="hidden" type="text" name="channel_id" value="' + obj["feedback"]["channel_id"] + '">' +
        '</form>';
        var form = document.getElementById('magic_form');
        if (form)
            form.submit();
    }
    else{
        var error_div = document.getElementById('error_div');
        error_div.setAttribute('class', error_div.getAttribute('class').replace(' hidden', ''));
        error_div.firstElementChild.innerHTML = obj["info"]["message"];
    }
}

function deleteNewsItem(news_id){
    var obj = asyncCaller[CALLER_INDEX.delete_news].responseObj;

    if (obj["info"]["error_code"] == 200 && obj["info"]["message"].indexOf("not") < 0){
        var news_div = document.getElementById('delete_btn_' + news_id).parentElement.parentElement.parentElement;
        news_div.remove();
    }
    else{

    }
}

function publishNewsItem(){

}

function extractResponseObject(caller){
    var response = null;
    if (caller.xhr.readyState == ResponseState.RESPONSE_COMPLETE && caller.xhr.responseText != null){
        //console.log(caller.xhr.responseText);
        var textResponse = caller.xhr.responseText;
        response = JSON.parse(textResponse);
    }
    return response;
}

function processResponse(caller, callback){
    var responseObject = extractResponseObject(caller);
    if (responseObject){
        caller.responseObj = responseObject;
        callback();
    }
    //else
        //console.log("No data");
}

EventCallBack.prototype.subscribe = function(channel_id){
    var caller = asyncCaller[CALLER_INDEX.subscribe];
    processResponse(caller, function(){subscribeToChannel(channel_id);});
};

EventCallBack.prototype.unSubscribe = function(channel_id){
    var caller = asyncCaller[CALLER_INDEX.unsubscribe];
    processResponse(caller, function(){unSubscribeFromChannel(channel_id);});
};

EventCallBack.prototype.like = function(news_id){
    var caller = asyncCaller[CALLER_INDEX.like];
    processResponse(caller, function(){likeNewsItem(news_id);});
};

EventCallBack.prototype.dislike = function(news_id){
    var caller = asyncCaller[CALLER_INDEX.dislike];
    processResponse(caller, function(){dislikeNewsItem(news_id);});
};

EventCallBack.prototype.comment = function(news_id){
    var caller = asyncCaller[CALLER_INDEX.comment];
    processResponse(caller, function(){commentOnNewsItem(news_id)});
};

EventCallBack.prototype.onLoadStart = function(){
    var body = document.getElementsByTagName('body')[0];
    body.setAttribute('class', 'loading');
        var loading_div = document.getElementsByClassName('modal-loading')[0];
    loading_div.style.display = "block";
};

EventCallBack.prototype.onLoadEnd = function(){
    var body = document.getElementsByTagName('body')[0];
    body.setAttribute('class', body.getAttribute('class').replace('loading', ''));
    var loading_div = document.getElementsByClassName('modal-loading')[0];
    loading_div.style.display = "none";
};

EventCallBack.prototype.parseNews = function (){
    var caller = asyncCaller[CALLER_INDEX.news];
    processResponse(caller, filler.fillNews);
};

EventCallBack.prototype.parseCategories = function(){
    var caller = asyncCaller[CALLER_INDEX.categories];
    if (current_page == PAGE.admin_home){
        processResponse(caller, filler.fillAdminCategories);
    }
    else{
        processResponse(caller, filler.fillCategories);
    }
};

EventCallBack.prototype.parseComments = function(){
    var caller = asyncCaller[CALLER_INDEX.comment];
    processResponse(caller, function(){filler.fillComments()});
};

EventCallBack.prototype.parseAllChannels = function(){
    var caller = asyncCaller[CALLER_INDEX.all_channels];
    processResponse(caller, filler.fillAllChannels);
};

EventCallBack.prototype.parseCategoryNews = function(){
    var caller = asyncCaller[CALLER_INDEX.category_news];
    processResponse(caller, filler.fillCategoryNews);
};

EventCallBack.prototype.parseLoginResponse = function(){
    var caller = asyncCaller[CALLER_INDEX.login];
    processResponse(caller, login);
};

EventCallBack.prototype.parseAdminLoginResponse = function(){
    var caller = asyncCaller[CALLER_INDEX.admin_login];
    processResponse(caller, adminLogin);
};

EventCallBack.prototype.parseChannelDetails = function(){
    var caller = asyncCaller[CALLER_INDEX.channel];
    processResponse(caller, filler.fillChannelDetails);
};

EventCallBack.prototype.parseChannelNews = function(channel_id){
    var callerArr = asyncCaller[CALLER_INDEX.channel_news];
    var caller = callerArr[channel_id];
    processResponse(caller, function(){filler.fillChannelNews(channel_id);});
};

EventCallBack.prototype.parseAllNews = function(){
    var caller = asyncCaller[CALLER_INDEX.all_news];
    processResponse(caller, filler.fillAllNews);
};

EventCallBack.prototype.parseAllNewsWithMarker = function(){
    var caller = asyncCaller[CALLER_INDEX.all_news_with_marker];
    processResponse(caller, filler.fillAllNewsWithMarker);
};

EventCallBack.prototype.parseSubscriptions = function(){
    var caller = asyncCaller[CALLER_INDEX.subscriptions];
    processResponse(caller, filler.fillSubscriptions);
};

EventCallBack.prototype.parseTrendingNews = function(){
    var caller = asyncCaller[CALLER_INDEX.trending_news];
    processResponse(caller, filler.fillTrendingNews);
};

EventCallBack.prototype.parseAdminPosts = function(){
    var caller = asyncCaller[CALLER_INDEX.admin_home];
    processResponse(caller, filler.fillAdminPosts);
};
EventCallBack.prototype.parseAdminAddNews = function(channel_id){
    var caller = asyncCaller[CALLER_INDEX.admin_add_news];
    processResponse(caller, function(){filler.fillAdminNews(channel_id)});
};

EventCallBack.prototype.parseAdminEditProfile = function(){
    var caller = asyncCaller[CALLER_INDEX.admin_edit_profile];
    processResponse(caller, editChannelProfile);
};

EventCallBack.prototype.deleteAdminPostItem = function(news_id){
    var caller = asyncCaller[CALLER_INDEX.delete_news];
    processResponse(caller, function(){deleteNewsItem(news_id);});
};

EventCallBack.prototype.parseUserRegisterResponse = function(){
    var caller = asyncCaller[CALLER_INDEX.user_register];
    processResponse(caller, registerUser);
};

EventCallBack.prototype.parseChannelRegisterResponse = function(){
    var caller = asyncCaller[CALLER_INDEX.channel_register];
    processResponse(caller, registerChannel);
};

var Getter = function(){};

Getter.prototype.getNews = function(news_id){
    if (!asyncCaller[CALLER_INDEX.news])
        asyncCaller[CALLER_INDEX.news] = new AsyncCaller();
    var url = (URL.news).replace('_ID', news_id);
    if (user_api_key != null && user_api_key != 0){
        url = url.replace(KEY.standard, user_api_key);
    }
    asyncCaller[CALLER_INDEX.news]
        .prepareRequest(Method.GET, url, eventCallBack.parseNews);
    asyncCaller[CALLER_INDEX.news].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getCategories = function(){
    if (!asyncCaller[CALLER_INDEX.categories])
        asyncCaller[CALLER_INDEX.categories ] = new AsyncCaller();

    asyncCaller[CALLER_INDEX.categories]
        .prepareRequest(Method.GET, URL.categories, eventCallBack.parseCategories);
    asyncCaller[CALLER_INDEX.categories].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getComment = function(news_id){
    //removePreviousComment();
    if (!asyncCaller[CALLER_INDEX.comment])
        asyncCaller[CALLER_INDEX.comment ] = new AsyncCaller();
    asyncCaller[CALLER_INDEX.comment]
        .prepareRequest(Method.GET, (URL.comments).replace('_ID', news_id), eventCallBack.parseComments);
    asyncCaller[CALLER_INDEX.comment].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getAllChannels = function(){

    if (!asyncCaller[CALLER_INDEX.all_channels])
        asyncCaller[CALLER_INDEX.all_channels ] = new AsyncCaller();

    var url = URL.all_channels;

    if (user_api_key && user_api_key != 0){
        url = (URL.all_channels)
            .replace(KEY.standard, user_api_key)
            .replace('channels', 'subscriptions');
    }

    asyncCaller[CALLER_INDEX.all_channels]
        .prepareRequest(Method.GET, url, eventCallBack.parseAllChannels);
    asyncCaller[CALLER_INDEX.all_channels].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getNewsByCategory = function(categoryId, lastId){
    if (!asyncCaller[CALLER_INDEX.category_news])
        asyncCaller[CALLER_INDEX.category_news] = new AsyncCaller();

    var url = (URL.news_by_category).replace('_ID', categoryId);
    if (lastId){
        url = (URL.news_by_category_with_marker)
            .replace('_ID', categoryId)
            .replace('_LAST', lastId)
            .replace('_TYPE', 'older');
    }
    asyncCaller[CALLER_INDEX.category_news]
        .prepareRequest(Method.GET, url, eventCallBack.parseCategoryNews);
    asyncCaller[CALLER_INDEX.category_news].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getChannelDetails = function(channel_id){
    if (!asyncCaller[CALLER_INDEX.channel])
        asyncCaller[CALLER_INDEX.channel ] = new AsyncCaller();

    var url = (URL.channel_details).replace('_ID', channel_id);

    if (user_api_key!=null && user_api_key != 0){
        url = url.replace(KEY.standard, user_api_key);
    }

    asyncCaller[CALLER_INDEX.channel]
        .prepareRequest(Method.GET, url, eventCallBack.parseChannelDetails);
    asyncCaller[CALLER_INDEX.channel].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getChannelNews = function(channel_id, lastId){
    if (!asyncCaller[CALLER_INDEX.channel_news])
        asyncCaller[CALLER_INDEX.channel_news] = [];
    if (!asyncCaller[CALLER_INDEX.channel_news][channel_id])
        asyncCaller[CALLER_INDEX.channel_news][channel_id] = new AsyncCaller();

    var url = (URL.news_by_channel).replace('_ID', channel_id);

    if (lastId){
        url = (URL.news_by_channel_with_marker)
            .replace('_ID', channel_id)
            .replace('_LAST', lastId)
            .replace('_TYPE', 'older');
    }
    asyncCaller[CALLER_INDEX.channel_news][channel_id]
        .prepareRequest(Method.GET, url, function(){eventCallBack.parseChannelNews(channel_id);});
    asyncCaller[CALLER_INDEX.channel_news][channel_id].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getAllNews = function(){
    if (!asyncCaller[CALLER_INDEX.all_news])
        asyncCaller[CALLER_INDEX.all_news ] = new AsyncCaller();

    var url = URL.all_news;
    if (user_api_key && user_api_key != 0){
        url = (URL.news_feed).replace('_API_KEY', user_api_key);
    }
    asyncCaller[CALLER_INDEX.all_news]
        .prepareRequest(Method.GET, url, eventCallBack.parseAllNews);
    asyncCaller[CALLER_INDEX.all_news].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getAllNewsWithMarker = function(last_news_id, type){
    if (!asyncCaller[CALLER_INDEX.all_news_with_marker])
        asyncCaller[CALLER_INDEX.all_news_with_marker ] = new AsyncCaller();

    var url = (URL.all_news_with_marker)
        .replace('_LAST_ID', last_news_id)
        .replace('_TYPE', type);

    if (user_api_key != null && user_api_key != 0){
        url = url.replace(KEY.standard, user_api_key);
    }
    asyncCaller[CALLER_INDEX.all_news_with_marker]
        .prepareRequest(Method.GET, url, eventCallBack.parseAllNewsWithMarker);
    asyncCaller[CALLER_INDEX.all_news_with_marker].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getMySubscriptions = function(){
    if (!asyncCaller[CALLER_INDEX.subscriptions])
        asyncCaller[CALLER_INDEX.subscriptions ] = new AsyncCaller();

    var url = URL.all_channels;
    if (user_api_key != null && user_api_key != 0){
        url = (URL.my_subscriptions).replace(KEY.standard, user_api_key);
    }
    asyncCaller[CALLER_INDEX.subscriptions]
        .prepareRequest(Method.GET, url, eventCallBack.parseSubscriptions);
    asyncCaller[CALLER_INDEX.subscriptions].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getTrendingNews = function(){
    if (!asyncCaller[CALLER_INDEX.trending_news])
        asyncCaller[CALLER_INDEX.trending_news ] = new AsyncCaller();

    var url = URL.trending_news;
    if (user_api_key != null && user_api_key != 0){
        url = (URL.trending_news);
    }
    asyncCaller[CALLER_INDEX.trending_news]
        .prepareRequest(Method.GET, url, eventCallBack.parseTrendingNews);
    asyncCaller[CALLER_INDEX.trending_news].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getAdminPosts = function(channel_id, lastId){
    if(!asyncCaller[CALLER_INDEX.admin_home])
        asyncCaller[CALLER_INDEX.admin_home] = new AsyncCaller();

    var url = (URL.news_by_channel).replace('_ID', channel_id);
    if (lastId){
        url = (URL.news_by_channel_with_marker)
            .replace('_ID', channel_id)
            .replace('_LAST', lastId)
            .replace('_TYPE', 'older');
    }

    asyncCaller[CALLER_INDEX.admin_home]
        .prepareRequest(Method.GET, url, eventCallBack.parseAdminPosts);
    asyncCaller[CALLER_INDEX.admin_home].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);

};

Getter.prototype.admin_load_more = function(channel_id, lastId){
    if(!asyncCaller[CALLER_INDEX.admin_load_more])
        asyncCaller[CALLER_INDEX.admin_load_more] = new AsyncCaller();

    var url = (URL.admin_load_more).replace('_ID', channel_id);

    if (lastId){
        url = (URL.news_by_channel_with_marker)
            .replace('_ID', channel_id)
            .replace('_LAST', lastId)
            .replace('_TYPE', 'older');
    }

    asyncCaller[CALLER_INDEX.admin_load_more]
        .prepareRequest(Method.GET, url, eventCallBack.admin_load_more);
    asyncCaller[CALLER_INDEX.admin_load_more].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

var Filler = function(){};

Filler.prototype.fillNews = function (){
    var obj = asyncCaller[CALLER_INDEX.news].responseObj["data"];
    var channel_name = document.getElementById('channel');
    var img_element = document.getElementById('news_image');
    var news_title_element = document.getElementById('news_title');
    var news_content_element = document.getElementById('news_content');
    var num_of_likes = document.getElementById('num_of_likes');
    var num_of_comments = document.getElementById('num_of_comments');
    var num_of_dislikes = document.getElementById('num_of_dislikes');

    channel_name.innerHTML = obj["channel_name"];
    img_element.src = obj["image_url"];
    if (img_element.src != DEFAULT_IMG_URL.news) img_element.setAttribute('class', 'block');
    news_title_element.innerHTML = obj["title"];
    news_content_element.innerHTML = obj["content"];

    num_of_comments.innerText = obj["comment_count"];


    var like_btn = document.getElementById('news_like_btn');
    var dislike_btn = document.getElementById('news_dislike_btn');
    var add_comment_btn = document.getElementById('add_comment_btn');


    if (user_api_key != null && user_api_key != 0){
        if ("true" == obj["liked"]){
            like_btn.disabled = true;
        }
        if ("true" == obj["disliked"]){
            dislike_btn.disabled = true;
        }
    }

    var news_id = obj["news_id"];
    if (news_id){
        if (add_comment_btn){
            add_comment_btn.onclick = function(){
                var comment = document.getElementById("comment");
                poster.addComment(news_id, comment.value);
                comment.value = "";
            };
        }

        // keep polling comments
        getter.getComment(news_id);
    }

    if (parseInt(obj["channel_id"]) == 1){
        var news_like_btn = document.getElementById('news_like_btn');
        var news_dislike_btn = document.getElementById('news_dislike_btn');

        if (news_like_btn) news_like_btn.remove();
        if (news_dislike_btn) news_dislike_btn.remove();
    }
    else{
        num_of_likes.innerText = obj["like_count"];
        num_of_dislikes.innerText = obj["dislike_count"];
        if (news_id){
            like_btn.onclick = function(){poster.likeNews(news_id)};
            dislike_btn.onclick = function(){poster.dislikeNews(news_id)};
        }

    }

};

Filler.prototype.fillComments = function (){
    var obj = asyncCaller[CALLER_INDEX.comment].responseObj["data"];

    var comment_div = document.getElementById('ccr-commnet');

    if (obj.length == 0){
        document.getElementById('comment_heading').setAttribute('class', 'hidden');
        document.getElementById('no_comment_heading').setAttribute('class', 'block text-center');
    }

    for (var i = 0; i < obj.length; i++){

        if (parseInt(obj[i]["comment_id"]) <= last_comment_id){
            continue;
        }
        console.log("LAST_COMMENT_ID  === >" + last_comment_id);
        var content = '<div class="well well-sm">'+'<div class="comment-authore col-md-1">' +
            '<img src="' + obj[i]["image_url"] +'"alt="' + obj[i]["username"] + '"class="img-responsive"' +'">' +
            '</div>'+
            '<div>' +
            '<header>' +
            '<span class="post-byline">' +
            '<span class="author publisher-anchor-color">' + obj[i]["username"] + '</span>' +
            '</span>' +
            '<span class="post-meta">' +
            '<span class="bullet time-ago-bullet" aria-hidden="true"> &nbsp; </span>' +
            '<a href="#">' + utility.getRelativeTime(obj[i]["created_at"]) + '</a>' +
            '</span>' +
            '</header>' +
            '</div>' +
            '<div class="post-body-inner">'+
            '<div class="comment-content">' +
            '<p>' + obj[i]["comment_content"] + '</p>' +
            '</div>' +
            '</div>'+
            '</div>';

        var div = document.createElement('div');
        div.innerHTML = content;
        comment_div.appendChild(div);
        last_comment_id = obj[i]["comment_id"];
    }


};

Filler.prototype.fillCategories = function (){
    var obj = asyncCaller[CALLER_INDEX.categories].responseObj["data"];
    //console.log(obj);

    var side_nav = document.getElementById('sidenav');

    for (var i = 0; i < obj.length; i++){
        var list_item = document.createElement('li');
        var link = '<a href="' + utility.getUrlFor('category/view/' + obj[i]["category_id"]) + '">' + obj[i]["category_name"].toUpperCase() + '</a>';
        list_item.innerHTML = link;
        side_nav.appendChild(list_item);
    }

};

Filler.prototype.fillAdminCategories = function () {

    var obj = asyncCaller[CALLER_INDEX.categories].responseObj["data"];

    if (obj && !obj.length > 0)
        return;
    var news_category = document.getElementById('news_category');
    for (var i = 0; i < obj.length; i++){
        var option = document.createElement('option');
        option.setAttribute('value', obj[i]["category_id"]);
        option.innerHTML = obj[i]["category_name"];
        news_category.appendChild(option);
    }
};

Filler.prototype.fillAllChannels = function(){
    var obj = asyncCaller[CALLER_INDEX.all_channels].responseObj["data"];

    var channels_container = document.getElementById('allChannelStyle');

    for (var i = 0; i < obj.length; i++){
        var div = document.createElement('div');
        div.setAttribute('class', "row");
        div.setAttribute('id', "side-newss");

        var btn_class = 'primary';
        var btn_label = 'SUBSCRIBE';
        var btn_href = 'href="' + utility.getUrlFor("login") + '"';
        var btn_onclick = null;
        var channel_id = obj[i]["channel_id"];

        if (user_api_key && user_api_key != 0){
            if (obj[i]["isSubscribed"] == 'true'){
                btn_class = 'danger';
                btn_label = 'UNSUBSCRIBE';
                btn_href = '';
                btn_onclick = function(){
                    var channel_id = this.getAttribute('id');
                    if (channel_id){
                        channel_id = parseInt(channel_id.replace('action_btn_', ''));
                        poster.unSubscribeFromChannel(channel_id);
                    }

                };
            }
            else{
                btn_class = 'success';
                btn_label = 'SUBSCRIBE';
                btn_href = '';
                btn_onclick = function(){
                    var channel_id = this.getAttribute('id');
                    if (channel_id){
                        channel_id = parseInt(channel_id.replace('action_btn_', ''));
                        poster.subscribeToChannel(channel_id);
                    }
                };
            }
        }

        var content = '<div class="center-block col-md-4">' +
            '<img src="' + obj[i]["channel_img_url"] + '" height="150px" width="auto">'+
            '</div>' +
            '<div class="col-md-8">' +
            '<p><b><a href="' + utility.getUrlFor("channel/view/" + obj[i]["channel_id"]) + '"' + '">' + obj[i]["channel_name"].toUpperCase() + '</a></b>' +
            '<a id="action_btn_' + obj[i]["channel_id"] + '" ' + btn_href + ' ><button class="btn btn-' + btn_class + ' pull-right" id="sbutton">'+ btn_label + ' | <span id="bold">' + obj[i]["subscriber_count"] + '</span></button></a><br></p>' +
            '<span>' + obj[i]["description"] + '</span>' +
            '</div>';
        div.innerHTML = content;
        channels_container.appendChild(div);

        var action_btn = document.getElementById('action_btn_' + obj[i]["channel_id"]);
        action_btn.onclick = btn_onclick;

        //if (i != (obj.length - 1)){
            channels_container.appendChild(document.createElement('hr'));
        //}

    }
};

Filler.prototype.fillCategoryNews = function(){

    var obj = asyncCaller[CALLER_INDEX.category_news].responseObj["data"];

    if (!obj.length > 0)
        return;

    var category_heading = document.getElementById('channelheading');
    category_heading.innerText = obj[0]["category_name"].toUpperCase();

    var parent = document.getElementById('ccr-latest-post-gallery');

    for (var i = 0; i < obj.length; i++){

        var news_row;

        if (parent.childElementCount > 1){
            var last_element = parent.lastElementChild;
            if (last_element.childElementCount < 4){
                news_row = last_element;
            }
            else{
                news_row = document.createElement('div');
                news_row.setAttribute('class', 'row');
                news_row.setAttribute('id', 'newsrow');
            }
        }
        else{
            news_row = document.createElement('div');
            news_row.setAttribute('class', 'row');
            news_row.setAttribute('id', 'newsrow');
        }

        var news_item = document.createElement('div');
        news_item.setAttribute('class', 'ccr-thumbnail col-md-3');
        var news = '<img id="news_' + obj[i]["news_id"] + '" src="' + obj[i]["image_url"] + '" alt="' + obj[i]["channel_name"] + obj[i]["news_id"] + '" height="100px" width="100px">' +
            '<div class="row" id="channelnam">' +
            '<br><span class="glyphicon glyphicon-thumbs-up">' + obj[i]["like_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-comment">' + obj[i]["comment_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-thumbs-down">' + obj[i]["dislike_count"] + '</span>&nbsp;' +
            '</div>' +
            '<a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"]) + '" id="link-font">' + utility.shortenText(obj[i]["title"], 50) + '</a>';

        index_channels.counts[obj[i]["channel_name"]]++;

        news_item.innerHTML = news;
        news_row.appendChild(news_item);
        parent.appendChild(news_row);

        var image_item = document.getElementById('news_' + obj[i]["news_id"]);
        if (obj[i]["image_url"] == "" || image_item.src == DEFAULT_IMG_URL.news){
            image_item.remove();
        }
    }

    var btn_div = document.getElementById('btn_div');
    if (!btn_div && obj.length >= MAX_NEWS_ITEM_PER_REQUEST){
        var container = document.createElement('div');
        container.setAttribute('class', 'row');
        btn_div = document.createElement('div');
        btn_div.setAttribute('class', 'col-md-12');
        btn_div.setAttribute('id', 'btn_div');
        btn_div.innerHTML = '<button class="btn btn-success" id="loadbutton">LOAD MORE</button>';
        btn_div.onclick = function(){
            btn_div.parentElement.remove();
            MAX_NEWS_ITEM_PER_REQUEST = 10;
            getter.getNewsByCategory(obj[i - 1]["category_id"], obj[i - 1]["news_id"]);
        };

        container.appendChild(btn_div);
        parent.appendChild(container);

    }

};

Filler.prototype.fillTrendingNews = function(){
    var obj = asyncCaller[CALLER_INDEX.trending_news].responseObj["data"];

    var parent = document.getElementById('trend_news');
    if (!parent)
        return;

    for (var i = 0; i < obj.length; i++){
        var news_div = document.createElement('div');
        news_div.setAttribute('class', 'ccr-thumbnail col-md-4 col-xs-6');
        if (obj[i]["image_url"] == "" || obj[i]["image_url"] == DEFAULT_IMG_URL.news){
            news_div.innerHTML = "";
        }
        else{
            news_div.innerHTML = '<img src="' + obj[i]["image_url"] + '" alt="Trending_' + i + '" height="100px" width="100px">';
        }
        news_div.innerHTML += '<div class="row" id="channelnam">' +
                            '<br><span class="glyphicon glyphicon-thumbs-up">' + obj[i]["like_count"] + '</span>&nbsp;' +
                            '<span class="glyphicon glyphicon-comment">' + obj[i]["comment_count"] + '</span>&nbsp;' +
                            '<span class="glyphicon glyphicon-thumbs-down">' + obj[i]["dislike_count"] + '</span>&nbsp;' +
                            '</div>' +
                            '<a href="channel.php" id="channelname">' + obj[i]["channel_name"] + '</a>' +
                            '<br><a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"]) + '" id="link-font">' + obj[i]["title"] + '</a>';

        parent.appendChild(news_div);
    }
};

Filler.prototype.fillChannelDetails = function(){
    var obj = asyncCaller[CALLER_INDEX.channel].responseObj["data"][0];
    var channel_name, channel_image, channel_desc;

    if (current_page == PAGE.admin_home){
        channel_name = document.getElementById('adminChannelName');
        if (channel_name){
            channel_name.value = obj["channel_name"];
        }
        channel_image = document.getElementById('adminNewPostImgDisplay');
        if (channel_image){
            channel_image.src = obj["channel_img_url"];
        }
        channel_desc = document.getElementById('adminProfileDesc');
        if (channel_desc){
            channel_desc.innerText = obj["description"];
        }
        return;
    }

    channel_name = document.getElementById('channelheading');
    channel_image = document.getElementById('channel_image');
    channel_desc = document.getElementById('channel_desc');
    var btn_paragraph = document.getElementById('btn_paragraph');

    channel_name.innerText = obj["channel_name"];
    channel_image.src = obj["channel_img_url"];
    channel_desc.innerHTML = obj["description"];

    var btn_class = 'primary';
    var btn_label = 'SUBSCRIBE';
    var btn_href = 'href="' + utility.getUrlFor("login") + '"';
    var btn_onclick = null;
    var channel_id = obj["channel_id"];

    if (user_api_key && user_api_key != 0){
        if (obj["isSubscribed"] == 'true'){
            btn_class = 'danger';
            btn_label = 'UNSUBSCRIBE';
            btn_href = '';
            btn_onclick = function(){
                var channel_id = this.getAttribute('id');
                if (channel_id){
                    channel_id = parseInt(channel_id.replace('action_btn_', ''));
                    poster.unSubscribeFromChannel(channel_id);
                }

            };
        }
        else{
            btn_class = 'success';
            btn_label = 'SUBSCRIBE';
            btn_href = '';
            btn_onclick = function(){
                var channel_id = this.getAttribute('id');
                if (channel_id){
                    channel_id = parseInt(channel_id.replace('action_btn_', ''));
                    poster.subscribeToChannel(channel_id);
                }
            };
        }
    }

    btn_paragraph.innerHTML = '<a id="action_btn_' + obj["channel_id"] + '" ' + btn_href + ' ><button class="btn btn-' + btn_class + ' pull-right" id="sbutton">'+ btn_label + '</button></a>';

    var action_btn = document.getElementById('action_btn_' + obj["channel_id"]);
    action_btn.onclick = btn_onclick;

};

Filler.prototype.fillChannelNews = function(channel_id){

    var obj = asyncCaller[CALLER_INDEX.channel_news][channel_id].responseObj["data"];

    var parent = document.getElementById('ccr-latest-post-gallery');
    var min_num_of_children = 3;

    if (current_page == PAGE.index){
        min_num_of_children = 1;
        var channel_news_count = index_channels.counts[index_channels.id[channel_id]];
        if (obj.length > 0){
            parent = document.getElementById('channel_' + obj[0]['channel_name']);
            if (parent)
                parent.setAttribute('class', 'block');
        }
        else if (channel_news_count > 0){
            parent = document.getElementById('channel_' + index_channels.id[channel_id]);
        }
        else{
            return;
        }
        if (channel_news_count >= MAX_INDEX_CHANNEL_NEWS_ITEMS) return;
    }

    var news_row;
    for (var i = 0; i < obj.length; i++){

        if (index_channels.counts[obj[i]["channel_name"]] >= 8){
            continue;
        }

        //if ( i % 4 == 0 || i == 0){
        if (parent.childElementCount > min_num_of_children){
            var last_element = parent.lastElementChild;
            if (last_element.childElementCount < 4){
                news_row = last_element;
            }
            else{
                news_row = document.createElement('div');
                news_row.setAttribute('class', 'row');
                news_row.setAttribute('id', 'newsrow');
            }
        }
        else{
            news_row = document.createElement('div');
            news_row.setAttribute('class', 'row');
            news_row.setAttribute('id', 'newsrow');
        }
        //}

        var news_item = document.createElement('div');
        news_item.setAttribute('class', 'ccr-thumbnail col-md-3');
        var news = '<img id="news_' + obj[i]["news_id"] + '" src="' + obj[i]["image_url"] + '" alt="' + obj[i]["channel_name"] + obj[i]["news_id"] + '" height="100px" width="100px">' +
            '<div class="row" id="channelnam">' +
            '<br><span class="glyphicon glyphicon-thumbs-up">' + obj[i]["like_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-comment">' + obj[i]["comment_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-thumbs-down">' + obj[i]["dislike_count"] + '</span>&nbsp;' +
            '</div>' +
            '<a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"]) + '" id="link-font">' + utility.shortenText(obj[i]["title"], 50) + '</a>';

        index_channels.counts[obj[i]["channel_name"]]++;

        news_item.innerHTML = news;
        news_row.appendChild(news_item);
        parent.appendChild(news_row);

        var image_item = document.getElementById('news_' + obj[i]["news_id"]);
        if (obj[i]["image_url"] == "" || image_item.src == DEFAULT_IMG_URL.news){
            image_item.remove();
        }
    }
    var btn_div = document.createElement('div');
    btn_div.setAttribute('class', 'col-md-12');
    if (current_page != PAGE.index){
        if (obj.length >= MAX_NEWS_ITEM_PER_REQUEST){
            btn_div.innerHTML = '<a class="btn btn-success" id="loadbutton">LOAD MORE</a>';
            btn_div.onclick = function(){
                btn_div.remove();
                MAX_NEWS_ITEM_PER_REQUEST = 10;
                getter.getChannelNews(obj[i - 1]["channel_id"], obj[i - 1]["news_id"]);
            };
        }

    }
    else{
        btn_div.innerHTML = '<a id="loadbutton" href="' + utility.getUrlFor("channels/view/" + channel_id) + '" class="btn btn-success">VIEW ALL</a>';
    }
    parent.appendChild(btn_div);
};

Filler.prototype.fillAdminPosts = function(){
    var obj = asyncCaller[CALLER_INDEX.admin_home].responseObj["data"];

    var parent = document.getElementById('postlist').firstElementChild;

    var first_child;

    for (var i = (obj.length - 1); i >= 0; i--){

        var news_id = obj[i]["news_id"];

        if (parseInt(news_id) <= parseInt(last_channel_news_id))
            continue;

        var li = document.createElement('li');

        li.innerHTML ='<div>' +
                '<p id="channelname">' + utility.shortenText(obj[i]["title"], 100) + '</p>' +
                '<p>' + '<a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"]) + '">' + utility.shortenText(obj[i]["content"], 200) + '</a>' +
                '<button id="delete_btn_' + obj[i]["news_id"] + '" class="btn btn-danger pull-right delete_btn" id="delbutton">Delete&nbsp;<span class="glyphicon glyphicon-trash"></span></button></p>' +
                '</div>';

        first_child = parent.firstElementChild;
        if (!first_child){
            parent.appendChild(li);
        }
        else{
            var hr = document.createElement('hr');
            parent.insertBefore(hr, first_child);

            parent.insertBefore(li, hr);
        }

        var delete_btn = document.getElementById('delete_btn_' + obj[i]["news_id"]);
        if (delete_btn){
            delete_btn.onclick = function(){
                var news_id = parseInt(this.getAttribute('id').replace('delete_btn_', ''));
                poster.deleteAdminPostItem(news_id);
            };
        }

        if (i != 0){

        }

        last_channel_news_id = news_id;

    }

    var k = obj[obj.length-1]['news_id'];
    console.log('k = ' + k);

    var load  = document.getElementById("load_more_posts");
    load.onclick = function(){
        getter.getAdminPosts(obj[i - 1]["channel_id"], k);
    }
};

Filler.prototype.fillAllNews = function(){

    var obj = asyncCaller[CALLER_INDEX.all_news].responseObj["data"];
    var limit = MAX_SLIDER_ITEMS;
    if (obj.length < MAX_SLIDER_ITEMS) limit = obj.length;
    var slider_div = document.getElementById('slider_div');
    var slider_indicators = document.getElementById('slider_indicators');

    var news_parent_div = document.getElementById('sideinfo');

    var main = document.getElementById('main_content');
    var channelArray = [];

    for (var i = 0; i < limit + MAX_SIDE_NEWS_ITEMS; i++){
        // fill slider
        if (channelArray.indexOf(obj[i]["channel_id"]) < 0){
            var channel_container = document.createElement('div');
            channel_container.setAttribute('class', 'row');
            channel_container.innerHTML = '<div class="col-md-12">' +
            '<section id="channel_' + obj[i]["channel_name"] + '">' +
            '<div class="ccr-gallery-ttile">' +
            '<span></span>' +
            '<p id="channelheading">' + obj[i]["channel_name"] + '<button class="btn btn-info pull-right"> view all </button>'+ '</p>' +
            '</div>' +
            '</section>' +
            '</div>';
            if (!index_channels.counts[obj[i]["channel_name"]]){
                index_channels.counts[obj[i]["channel_name"]] = 0;
                index_channels.id[obj[i]["channel_id"]] = obj[i]["channel_name"];
            }
            main.appendChild(channel_container);
            channelArray.push(obj[i]["channel_id"]);
        }

        index_channels.lastIDs[obj[i]["channel_name"]] = obj[i]["news_id"];

        if (i < limit){
            var content_div = document.createElement('div');
            content_div.setAttribute('class', ((i == 0) ? 'active ' : '') + 'item' );
            content_div.innerHTML = '<div class="container slide-element">' +
            '<img src="' + obj[i]["image_url"] + '"  width="530px" height="370px">' +
            '<p><a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"] ) + '">' + obj[i]["title"] + '</a></p>' +
            '</div>';

            // fill slider indicators
            var list_item = document.createElement('li');
            list_item.setAttribute('data-target', '#ccr-slide-main');
            list_item.setAttribute('data-slide-to', i + '');
            if (i == 0) list_item.setAttribute('class', 'active');

            slider_div.appendChild(content_div);
            slider_indicators.appendChild(list_item);
        }
        else{
            var news_div = document.createElement('div');
            news_div.setAttribute('class', 'row');
            news_div.setAttribute('id', 'side-news');
            news_div.innerHTML = '<div class="col-md-1">' +
            '<img src="' + obj[i]["image_url"] + '" alt="' + obj[i]["channel_name"] + obj[i]["news_id"]+ '" height="60px" width="60px">' +
            '</div>' +
            '<div class="col-md-10" id="channelnam">' +
            '<span class="glyphicon glyphicon-thumbs-up">' + obj[i]["like_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-comment">' + obj[i]["comment_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-thumbs-down">' + obj[i]["dislike_count"] + '</span>&nbsp;' +
            '<br><a href="' + utility.getUrlFor("channel/view/" + obj[i]["channel_id"]) + '" id="channelname">' + obj[i]["channel_name"] + '</a>' +
            '<br> <span><a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"]) + '"  id="link-font">' + utility.shortenText(obj[i]["title"], 25) + '</a></span>'+
            '</div>';

            news_parent_div.appendChild(news_div);
        }

    }

    //getter.getAllNewsWithMarker(obj[i]["news_id"], "older");
    getter.getMySubscriptions();
};

Filler.prototype.fillAllNewsWithMarker = function(){

    var obj = asyncCaller[CALLER_INDEX.all_news_with_marker].responseObj["data"];

    var main = document.getElementById('main_content');
    var channelArray = [];
    var news_row;
    var parent;

    for (var i = 0; i < obj.length; i++){

        if (channelArray.indexOf(obj[i]["channel_id"]) < 0){
            var channel_container = document.createElement('div');
            channel_container.setAttribute('class', 'row');
            channel_container.innerHTML = '<div class="col-md-12">' +
            '<section id="channel_' + obj[i]["channel_name"] + '">' +
            '<div class="ccr-gallery-ttile">' +
            '<span></span>' +
            '<p id="channelheading">' + obj[i]["channel_name"] + '</p>' +
            '</div>' +
            '</section>' +
            '</div>';
            if (!index_channels.counts[obj[i]["channel_name"]]){
                index_channels.counts[obj[i]["channel_name"]] = 0;
                index_channels.id[obj[i]["channel_id"]] = obj[i]["channel_name"];
            }
            main.appendChild(channel_container);
            channelArray.push(obj[i]["channel_id"]);
        }

        index_channels.lastIDs[obj[i]["channel_name"]] = obj[i]["news_id"];

        //console.log(index_channels.counts);
        parent = document.getElementById('channel_' + obj[i]["channel_name"]);


        if (index_channels.counts[obj[i]["channel_name"]] >= MAX_INDEX_CHANNEL_NEWS_ITEMS){
            continue;
        }

        if ( i % 4 == 0 || i == 0){
            news_row = document.createElement('div');
            news_row.setAttribute('class', 'row');
            news_row.setAttribute('id', 'newsrow');
        }

        var news_item = document.createElement('div');
        news_item.setAttribute('class', 'ccr-thumbnail col-md-3');
        var news = '<img src="' + obj[i]["image_url"] + '" alt="' + obj[i]["channel_name"] + obj[i]["news_id"] + '" height="100px" width="100px">' +
            '<div class="row" id="channelnam">' +
            '<br><span class="glyphicon glyphicon-thumbs-up">' + obj[i]["like_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-comment">' + obj[i]["comment_count"] + '</span>&nbsp;' +
            '<span class="glyphicon glyphicon-thumbs-down">' + obj[i]["dislike_count"] + '</span>&nbsp;' +
            '</div>' +
            '<a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"]) + '" id="link-font">' + utility.shortenText(obj[i]["title"], 50) + '</a>';

        news_item.innerHTML = news;
        news_row.appendChild(news_item);

        parent.appendChild(news_row);

        index_channels.counts[obj[i]["channel_name"]]++;
        if (index_channels.counts[obj[i]["channel_name"]] == MAX_INDEX_CHANNEL_NEWS_ITEMS){
            var btn_div = document.createElement('div');
            btn_div.setAttribute('class', 'col-md-12');
            btn_div.innerHTML = '<a id="loadbutton" href="' + utility.getUrlFor("channels/view/" + obj[i]["channel_id"]) + '" class="btn btn-success">VIEW ALL</a>';
            parent.appendChild(btn_div);

        }
    }

    getter.getMySubscriptions();
};

Filler.prototype.fillSubscriptions = function(){

    var obj = asyncCaller[CALLER_INDEX.subscriptions].responseObj["data"];

    var main = document.getElementById('main_content');

    for (var i = 0; i < obj.length; i++){
        if (user_api_key && user_api_key != 0){
            if (obj[i]["isSubscribed"] != "true" && obj[i]["channel_id"] != 1)
                continue;
        }

        if (!index_channels.counts[obj[i]["channel_name"]]) {
            index_channels.id[obj[i]["channel_id"]] = obj[i]["channel_name"];
            index_channels.counts[obj[i]["channel_name"]] = 0;
        }

        if (!document.getElementById('channel_' + obj[i]["channel_name"])){
            var channel_container = document.createElement('div');
            channel_container.setAttribute('class', 'row');
            channel_container.innerHTML = '<div class="col-md-12">' +
            '<section id="channel_' + obj[i]["channel_name"] + '" class="hidden">' +
            '<div class="ccr-gallery-ttile">' +
            '<span></span>' +
            '<p id="channelheading">' + obj[i]["channel_name"] + '</p>' +
            '</div>' +
            '</section>' +
            '</div>';
            main.appendChild(channel_container);

            getter.getChannelNews(obj[i]["channel_id"]);
        }
        else{
            getter.getChannelNews(obj[i]["channel_id"], index_channels.lastIDs[obj[i]["channel_name"]]);
        }

    }

    var index_channels_keys = Object.keys(index_channels.counts);
    var len = index_channels_keys.length;
    var mid_channel = index_channels_keys[len / 2];

    var before_trending = document.getElementById('channel_' + mid_channel).parentElement.parentElement;
    var trending = document.getElementById('trends').parentElement;
    main.insertBefore(trending, before_trending);

    //getter.getUserNewsFeed(user_api_key);
};

Filler.prototype.fillAdminNews = function(channel_id){
    var obj = asyncCaller[CALLER_INDEX.admin_add_news].responseObj;

    if (obj["info"]["error_code"] == 400){
        getter.getAdminPosts(channel_id);
    }else{

    }
};

var Poster = function(){};

Poster.prototype.postAdminNews = function(channel_id){
    //this.preventDefault();
    var title_element = document.getElementById("adminNewPostTitle");
    var news_category = document.getElementById("news_category");
    var news_detail_element = document.getElementById("adminNewPostDetails");
    var external_link = document.getElementById("adminNewPostLink");
    var upload_file = document.getElementById("adminNewPostImageUrl");
    //  var img_element =document.getElementsByClassName("img_url");

    var post = new FormData();
    post.append("news_channel_id", channel_id );
    post.append("category_id", news_category.value);
    post.append("title", title_element.value);
    post.append("content", news_detail_element.value);
    post.append("external_link", external_link.value);
    post.append("image_url",upload_file.files[0]);

    if(!asyncCaller[CALLER_INDEX.admin_add_news])
        asyncCaller[CALLER_INDEX.admin_add_news] = new AsyncCaller();

    var url = URL.admin_add_news;
    if (user_api_key != null && user_api_key != 0){
        url = url.replace(KEY.standard, user_api_key);
    }
    asyncCaller[CALLER_INDEX.admin_add_news]
        .prepareRequest(Method.POST, url, function(){eventCallBack.parseAdminAddNews(channel_id)});
    asyncCaller[CALLER_INDEX.admin_add_news].makeRequest(post, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.postAdminProfile = function(channel_id){
    //this.preventDefault();
    var channel_name_element = document.getElementById("adminChannelName");
    var description_element =  document.getElementById("adminProfileDesc");
    var upload_file = document.getElementById("adminProfileImg");

    var data = new FormData();
    data.append("channel_name", channel_name_element.value);
    data.append("channel_id", channel_id);
    data.append("channel_img_url", upload_file.files[0]);
    data.append("description",description_element.value);

    if(!asyncCaller[CALLER_INDEX.admin_edit_profile])
        asyncCaller[CALLER_INDEX.admin_edit_profile] = new AsyncCaller();
    var url = URL.admin_edit_profile;
    if (user_api_key != null && user_api_key != 0){
        url = url.replace(KEY.standard, user_api_key);
    }

    asyncCaller[CALLER_INDEX.admin_edit_profile]
        .prepareRequest(Method.POST, url, eventCallBack.parseAdminEditProfile);
    asyncCaller[CALLER_INDEX.admin_edit_profile].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.postUserLoginCredentials = function(){
    //this.preventDefault();
    var username_email = document.getElementById('username_email').value;
    var password = document.getElementById('user_password').value;

    if (!asyncCaller[CALLER_INDEX.login])
        asyncCaller[CALLER_INDEX.login] = new AsyncCaller();

    asyncCaller[CALLER_INDEX.login]
        .prepareRequest(Method.POST, URL.login, eventCallBack.parseLoginResponse);

    var data = new FormData();
    data.append("username_email", username_email);
    data.append("password", password);

    asyncCaller[CALLER_INDEX.login].makeRequest(data);
};

Poster.prototype.postAdminLoginCredentials = function(){
    //this.preventDefault();
    var username = document.getElementById('admin_username').value;
    var password = document.getElementById('admin_password').value;

    if (!asyncCaller[CALLER_INDEX.admin_login])
        asyncCaller[CALLER_INDEX.admin_login] = new AsyncCaller();

    asyncCaller[CALLER_INDEX.admin_login]
        .prepareRequest(Method.POST, URL.admin_login, eventCallBack.parseAdminLoginResponse);

    var data = new FormData();
    data.append("username", username);
    data.append("password", password);

    asyncCaller[CALLER_INDEX.admin_login].makeRequest(data);
};

Poster.prototype.postUserRegistrationDetails = function(){
    //this.preventDefault();
    var username = document.getElementById('username');
    var email = document.getElementById('user_email');
    var password = document.getElementById('password');

    var data = new FormData();
    data.append("username", username.value);
    data.append("email", email.value);
    data.append("password", password.value);

    if (!asyncCaller[CALLER_INDEX.user_register])
        asyncCaller[CALLER_INDEX.user_register] = new AsyncCaller();

    var url = URL.user_register;
    asyncCaller[CALLER_INDEX.user_register].prepareRequest(Method.POST, url, eventCallBack.parseUserRegisterResponse);
    asyncCaller[CALLER_INDEX.user_register].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.postChannelRegistrationDetails = function(){
    if (!(user_api_key != null && user_api_key != 0))
        return;

    var channel_name = document.getElementById('channel_name');
    var description = document.getElementById('channel_desc');
    var username = document.getElementById('user_name');
    var password = document.getElementById('pass_word');
    var channel_img = document.getElementById('channel_img');
    var channel_img_url = channel_img.files[0];


    var data = new FormData();
    data.append("channel_name", channel_name.value);
    data.append("username", username.value);
    data.append("description", description.value);
    data.append("password", password.value);
    data.append("channel_img_url", channel_img_url);

    if (!asyncCaller[CALLER_INDEX.channel_register])
        asyncCaller[CALLER_INDEX.channel_register] = new AsyncCaller();

    var url = (URL.channel_register).replace(KEY.standard, user_api_key);
    asyncCaller[CALLER_INDEX.channel_register].prepareRequest(Method.POST, url, eventCallBack.parseChannelRegisterResponse);
    asyncCaller[CALLER_INDEX.channel_register].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.subscribeToChannel = function(channel_id){
    if (user_api_key == null || user_api_key == 0)
        return;
    var data = new FormData();
    data.append("channel_id", channel_id);

    if (!asyncCaller[CALLER_INDEX.subscribe])
        asyncCaller[CALLER_INDEX.subscribe] = new AsyncCaller();
    var url = (URL.subscribe).replace(KEY.standard, user_api_key);
    asyncCaller[CALLER_INDEX.subscribe].prepareRequest(Method.POST, url, function(){eventCallBack.subscribe(channel_id);});

    asyncCaller[CALLER_INDEX.subscribe].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.unSubscribeFromChannel = function(channel_id){
    if (user_api_key == null || user_api_key == 0)
        return;
    var data = new FormData();
    data.append("channel_id", channel_id);

    if (!asyncCaller[CALLER_INDEX.unsubscribe])
        asyncCaller[CALLER_INDEX.unsubscribe] = new AsyncCaller();
    var url = (URL.unSubscribe).replace(KEY.standard, user_api_key);
    asyncCaller[CALLER_INDEX.unsubscribe].prepareRequest(Method.POST, url, function(){eventCallBack.unSubscribe(channel_id);});

    asyncCaller[CALLER_INDEX.unsubscribe].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.likeNews = function(news_id){
    if (user_api_key == null || user_api_key == 0)
        return;
    var data = new FormData();
    data.append("news_id", news_id);

    if (!asyncCaller[CALLER_INDEX.like])
        asyncCaller[CALLER_INDEX.like] = new AsyncCaller();
    var url = (URL.like).replace(KEY.standard, user_api_key);
    asyncCaller[CALLER_INDEX.like].prepareRequest(Method.POST, url, function(){eventCallBack.like(news_id);});

    asyncCaller[CALLER_INDEX.like].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.dislikeNews = function(news_id){
    if (user_api_key == null || user_api_key == 0)
        return;
    var data = new FormData();
    data.append("news_id", news_id);

    if (!asyncCaller[CALLER_INDEX.dislike])
        asyncCaller[CALLER_INDEX.dislike] = new AsyncCaller();
    var url = (URL.dislike).replace(KEY.standard, user_api_key);
    asyncCaller[CALLER_INDEX.dislike].prepareRequest(Method.POST, url, function(){eventCallBack.dislike(news_id);});

    asyncCaller[CALLER_INDEX.dislike].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.addComment = function(news_id, comment){
    if (user_api_key == null || user_api_key == 0)
        return;
    var data = new FormData();
    data.append("object_id", news_id);
    data.append("comment_type", "provided");
    data.append("comment_content", comment);

    if (!asyncCaller[CALLER_INDEX.add_comment])
        asyncCaller[CALLER_INDEX.add_comment] = new AsyncCaller();
    var url = (URL.add_comment).replace(KEY.standard, user_api_key);
    asyncCaller[CALLER_INDEX.add_comment].prepareRequest(Method.POST, url, function(){eventCallBack.comment(news_id);});

    asyncCaller[CALLER_INDEX.add_comment].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Poster.prototype.deleteAdminPostItem = function(news_id){
    if (user_api_key == null || user_api_key == 0)
        return;
    var data = new FormData();
    data.append("news_id", news_id);

    if (!asyncCaller[CALLER_INDEX.delete_news])
        asyncCaller[CALLER_INDEX.delete_news] = new AsyncCaller();
    var url = (URL.delete_news).replace(KEY.standard, user_api_key);
    asyncCaller[CALLER_INDEX.delete_news].prepareRequest(Method.POST, url, function(){eventCallBack.deleteAdminPostItem(news_id);});

    asyncCaller[CALLER_INDEX.delete_news].makeRequest(data, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

function setUp(page){
    if (!eventCallBack)
        eventCallBack = new EventCallBack();
    if (!getter)
        getter = new Getter();
    if (!filler)
        filler = new Filler();
    if (!poster)
        poster = new Poster();
    if (!utility)
        utility = new Utility();
    fireCalls(page);
}

function fireCalls(page){
    current_page = page;

    if (current_page != PAGE.admin_home
        && current_page != PAGE.admin_login
        && current_page != PAGE.channel_register){
        // get the side nav loaded
        getter.getCategories();
    }

    var credentials_elt = document.getElementById('cred');
    if (credentials_elt){
        var user_credentials = credentials_elt.innerText.split('_');
        var user_id = user_credentials[1];
        user_api_key = user_credentials[0];
    }

    console.log('USER_API_KEY ' + user_api_key);

    switch (page){
        case PAGE.index:
            getter.getAllNews();
            getter.getTrendingNews();
            break;
        case PAGE.login:
            var login_btn = document.getElementById('login_btn');
            login_btn.onclick = poster.postUserLoginCredentials;
            break;
        case PAGE.admin_login:
            var admin_login_btn = document.getElementById('admin_login_btn');
            admin_login_btn.onclick = poster.postAdminLoginCredentials;
            break;
        case PAGE.user_register:
            var register_btn = document.getElementById('newbutton');
            register_btn.onclick = poster.postUserRegistrationDetails;
            break;
        case PAGE.channel_register:
            var channel_register_btn = document.getElementById('newbutton');
            channel_register_btn.onclick = poster.postChannelRegistrationDetails;
            var channel_img = document.getElementById('channel_img');
            var channel_img_display = document.getElementById('channel_img_display');
            channel_img.onchange = function(){
                var fileReader = new FileReader();
                fileReader.onload = function(){
                    if (fileReader.readyState == 2){
                        channel_img_display.src = fileReader.result;
                    }
                };
                fileReader.readAsDataURL(this.files[0]);
            };
            break;
        case PAGE.channels:
            var channelId = document.getElementById('channel_id').innerText;
            getter.getChannelDetails(channelId);
            getter.getChannelNews(channelId);
            break;
        case PAGE.category:
            var categoryId = document.getElementById('category_id').innerText;
            getter.getNewsByCategory(categoryId);
            break;
        case PAGE.news:
            var newsId = document.getElementById('news_id').innerText;
            getter.getNews(newsId);
            break;
        case PAGE.all_channels:
            getter.getAllChannels();
            break;
        case PAGE.admin_home:
            getter.getCategories();
            var channel_id = parseInt(document.getElementById('channel_id').innerText);
            getter.getAdminPosts(channel_id);
            getter.getChannelDetails(channel_id);
            var publish = document.getElementById("adminNewPostPublish");
            publish.onclick = function(){
                poster.postAdminNews(channel_id);
            };
            var saveButton = document.getElementById("adminSave");
            saveButton.onclick = function(){
                poster.postAdminProfile(channel_id);
            };
            var news_image = document.getElementById('adminNewPostImageUrl');
            if (news_image){
                news_image.onchange = function(){
                    var fileReader = new FileReader();
                    fileReader.onload = function(){
                        if (fileReader.readyState == 2){
                            var news_display_img = document.getElementById('news_display_img');
                            news_display_img.src = fileReader.result;
                        }
                    };
                    fileReader.readAsDataURL(this.files[0]);
                };
            }
            var channel_image = document.getElementById('adminProfileImg');
            if (channel_image){
                channel_image.onchange = function(){
                    var fileReader = new FileReader();
                    fileReader.onload = function(){
                        if (fileReader.readyState == 2){
                            var channel_display_img = document.getElementById('adminNewPostImgDisplay');
                            channel_display_img.src = fileReader.result;
                        }
                    };
                    fileReader.readAsDataURL(this.files[0]);
                };
            }
            break;
        default :
            console.log('Unknown Page');
    }

}