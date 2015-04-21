/**
 * Created by root on 4/15/15.
 */

var eventCallBack, getter, filler;
var utility;
var user_api_key = null;
var focused_news_id = null;

var asyncCaller = [];

var index_channels = {
    counts: {},
    lastIDs: {}
};

var current_page;
var PAGE = {
    index: 1,
    login: 2,
    channels: 3,
    all_channels: 4,
    news: 5,
    category: 6
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
    all_news_with_marker: 13
};

var KEY = {
    standard: "5cd84de2d3c90164b343708e701963e8",
    admin: "3aa2a3173c895a4618a15e4960bed678"
};

var BASE_URL = "http://webo.oauife.edu.ng/gist/api";

var URL = {
    login: BASE_URL + "/users/login?key=" + KEY.standard,
    local_login_file: "http://localhost/web/login/verify",
    news: BASE_URL + "/news/news_by_id/_ID?key=" + KEY.standard,
    news_by_category: BASE_URL + "/news/category/_ID?key=" + KEY.standard,
    categories: BASE_URL + "/categories?key=" + KEY.standard,
    news_by_channel: BASE_URL + "/news/channels/_ID?key=" + KEY.standard,
    news_feed: BASE_URL + "/news_feed?key=_API_KEY",
    news_feed_with_marker: BASE_URL + "/news_feed?marker=_LAST_ID&type=_TYPE&key=_API_KEY",
    all_news: BASE_URL + "/news?key=" + KEY.standard,
    all_news_with_marker: BASE_URL + "/news?marker=_LAST_ID&type=_TYPE&key=" + KEY.standard,
    channel_details: BASE_URL + "/channels/_ID?key=" + KEY.standard,
    comments: BASE_URL + "/comments/_ID?key=" + KEY.standard,
    all_channels: BASE_URL + "/channels?key=" + KEY.standard,
    my_subscriptions: BASE_URL + "/subscriptions?key=" + KEY.standard
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

function extractResponseObject(caller){
    var response = null;
    if (caller.xhr.readyState == ResponseState.RESPONSE_COMPLETE && caller.xhr.responseText != null){
        console.log(caller.xhr.responseText);
        var textResponse = caller.xhr.responseText;
        response = JSON.parse(textResponse);
    }
    return response;
}

EventCallBack.prototype.like = function(){

};

EventCallBack.prototype.dislike = function(){

};

EventCallBack.prototype.comment = function(){

};

EventCallBack.prototype.loadMore = function(){

};

EventCallBack.prototype.onLoadStart = function(){
    console.log("LOAD STARTS");
    var loading_div = document.getElementById('loading_div');
    loading_div.style.display = "block";
};

EventCallBack.prototype.onLoadEnd = function(){
    console.log("LOAD END");
    var loading_div = document.getElementById('loading_div');
    loading_div.style.display = "none";
};

EventCallBack.prototype.parseNews = function (){
    var caller = asyncCaller[CALLER_INDEX.news];
    var responseObject = extractResponseObject(caller);
//    console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.news].responseObj = responseObject;
        filler.fillNews();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseCategories = function(){
    var caller = asyncCaller[CALLER_INDEX.categories];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.categories].responseObj = responseObject;
        filler.fillCategories();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseComments = function(){
    var caller = asyncCaller[CALLER_INDEX.comment];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.comment].responseObj = responseObject;
        filler.fillComments();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseAllChannels = function(){
    var caller = asyncCaller[CALLER_INDEX.all_channels];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.all_channels].responseObj = responseObject;
        filler.fillAllChannels();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseCategoryNews = function(){
    var caller = asyncCaller[CALLER_INDEX.category_news];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.category_news].responseObj = responseObject;
        filler.fillCategoryNews();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseLoginResponse = function(){
    var caller = asyncCaller[CALLER_INDEX.login];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.login].responseObj = responseObject;
        login();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseChannelDetails = function(){
    var caller = asyncCaller[CALLER_INDEX.channel];
    var responseObject = extractResponseObject(caller);
    console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.channel].responseObj = responseObject;
        filler.fillChannelDetails();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseChannelNews = function(){
    var caller = asyncCaller[CALLER_INDEX.channel_news];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.channel_news].responseObj = responseObject;
        filler.fillChannelNews();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseAllNews = function(){
    var caller = asyncCaller[CALLER_INDEX.all_news];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.all_news].responseObj = responseObject;
        filler.fillAllNews();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseAllNewsWithMarker = function(){
    var caller = asyncCaller[CALLER_INDEX.all_news_with_marker];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.all_news_with_marker].responseObj = responseObject;
        filler.fillAllNewsWithMarker();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseSubscriptions = function(){
    var caller = asyncCaller[CALLER_INDEX.subscriptions];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.subscriptions].responseObj = responseObject;

        filler.fillSubscriptions();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseUserNewsFeed = function(){
    var caller = asyncCaller[CALLER_INDEX.user_news_feed];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.user_news_feed].responseObj = responseObject;
        filler.fillUserNewsFeed();
    }
    else
        console.log("No data");
};

EventCallBack.prototype.parseUserNewsFeedWithMarker = function(){
    var caller = asyncCaller[CALLER_INDEX.user_news_feed_with_marker];
    var responseObject = extractResponseObject(caller);
    //console.log(responseObject);
    if (responseObject){
        caller.responseObj = responseObject;
        asyncCaller[CALLER_INDEX.user_news_feed_with_marker].responseObj = responseObject;
        filler.fillUserNewsFeedWithMarker();
    }
    else
        console.log("No data");
};

var Getter = function(){};

Getter.prototype.getNews = function(news_id){
    asyncCaller[CALLER_INDEX.news]
        .prepareRequest(Method.GET, (URL.news).replace('_ID', news_id), eventCallBack.parseNews);
    asyncCaller[CALLER_INDEX.news].makeRequest(null);
};

Getter.prototype.getCategories = function(){
    asyncCaller[CALLER_INDEX.categories]
        .prepareRequest(Method.GET, URL.categories, eventCallBack.parseCategories);
    asyncCaller[CALLER_INDEX.categories].makeRequest(null, eventCallBack.onLoadStart, eventCallBack.onLoadEnd);
};

Getter.prototype.getComment = function(news_id){
    asyncCaller[CALLER_INDEX.comment]
        .prepareRequest(Method.GET, (URL.comments).replace('_ID', news_id), eventCallBack.parseComments);
    asyncCaller[CALLER_INDEX.comment].makeRequest(null);
};

Getter.prototype.getAllChannels = function(){
    var url = URL.all_channels;

    if (user_api_key){
        url = (URL.all_channels)
            .replace(KEY.standard, user_api_key)
            .replace('channels', 'subscriptions');
    }

    asyncCaller[CALLER_INDEX.all_channels]
        .prepareRequest(Method.GET, url, eventCallBack.parseAllChannels);
    asyncCaller[CALLER_INDEX.all_channels].makeRequest(null);
};

Getter.prototype.getNewsByCategory = function(categoryId){
    asyncCaller[CALLER_INDEX.category_news]
        .prepareRequest(Method.GET, (URL.news_by_category).replace('_ID', categoryId), eventCallBack.parseCategoryNews);
    asyncCaller[CALLER_INDEX.category_news].makeRequest(null);
};

Getter.prototype.getChannelDetails = function(channel_id){
    asyncCaller[CALLER_INDEX.channel]
        .prepareRequest(Method.GET, (URL.channel_details).replace('_ID', channel_id), eventCallBack.parseChannelDetails);
    asyncCaller[CALLER_INDEX.channel].makeRequest(null);
};

Getter.prototype.getChannelNews = function(channel_id){
    asyncCaller[CALLER_INDEX.channel_news]
        .prepareRequest(Method.GET, (URL.news_by_channel).replace('_ID', channel_id), eventCallBack.parseChannelNews);
    asyncCaller[CALLER_INDEX.channel_news].makeRequest(null);
};

Getter.prototype.getAllNews = function(){
    asyncCaller[CALLER_INDEX.all_news]
        .prepareRequest(Method.GET, URL.all_news, eventCallBack.parseAllNews);
    asyncCaller[CALLER_INDEX.all_news].makeRequest(null);
};

Getter.prototype.getAllNewsWithMarker = function(last_news_id, type){
    var url = (URL.all_news_with_marker)
        .replace('_LAST_ID', last_news_id)
        .replace('_TYPE', type);
    asyncCaller[CALLER_INDEX.all_news_with_marker]
        .prepareRequest(Method.GET, url, eventCallBack.parseAllNewsWithMarker);
    asyncCaller[CALLER_INDEX.all_news_with_marker].makeRequest(null);
};

Getter.prototype.getUserNewsFeed = function(){
    asyncCaller[CALLER_INDEX.user_news_feed]
        .prepareRequest(Method.GET, (URL.news_feed).replace('_API_KEY', user_api_key), eventCallBack.parseUserNewsFeed);
    asyncCaller[CALLER_INDEX.user_news_feed].makeRequest(null);
};

Getter.prototype.getUserNewsFeedWithMarker = function(last_news_id, type){
    var url = (URL.news_feed_with_marker)
        .replace('_API_KEY', user_api_key)
        .replace('_LAST_ID', last_news_id)
        .replace('_TYPE', type);
    asyncCaller[CALLER_INDEX.user_news_feed_with_marker]
        .prepareRequest(Method.GET, url, eventCallBack.parseUserNewsFeedWithMarker);
    asyncCaller[CALLER_INDEX.user_news_feed_with_marker].makeRequest(null);
};

Getter.prototype.getMySubscriptions = function(){
    var url = URL.all_channels;
    if (user_api_key != null && user_api_key != 0){
        url = (URL.my_subscriptions).replace('_API_KEY', user_api_key);
    }
    asyncCaller[CALLER_INDEX.subscriptions]
        .prepareRequest(Method.GET, url, eventCallBack.parseSubscriptions);
    asyncCaller[CALLER_INDEX.subscriptions].makeRequest(null);
};

var Filler = function(){};

Filler.prototype.fillNews = function (){
    var obj = asyncCaller[CALLER_INDEX.news].responseObj["data"];
    //console.log(obj);
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
    news_title_element.innerText = obj["title"];
    news_content_element.innerText = obj["content"];
    num_of_likes.innerText = obj["like_count"];
    num_of_comments.innerText = obj["comment_count"];
    num_of_dislikes.innerText = obj["dislike_count"];
};

Filler.prototype.fillComments = function (){
    var obj = asyncCaller[CALLER_INDEX.comment].responseObj["data"];

    var comment_div = document.getElementById('comment_div');

    for (var i = 0; i < obj.length; i++){
        var content = '<div class="comment-authore col-md-1">' +
                            '<img src="' + obj[i]["image_url"] +'" alt="' + obj[i]["username"] + '">' +
                      '</div>'+
                      '<div>' +
                            '<header>' +
                            '<span class="post-byline">' +
                                '<span class="author publisher-anchor-color">' + obj[i]["username"] + '</span>' +
                            '</span>' +
                            '<span class="post-meta">' +
                                '<span class="bullet time-ago-bullet" aria-hidden="true">•</span>' +
                                '<a href="#">2 months ago</a>' +
                            '</span>' +
                            '</header>' +
                      '</div>' +
                       '<div class="post-body-inner">'+
                            '<div class="comment-content">' +
                                '<p>' + obj[i]["comment_content"] + '</p>' +
                            '</div>' +
                       '</div>';

        var div = document.createElement('div');
        div.innerHTML = content;
        comment_div.appendChild(div);
    }
    console.log(obj);
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

Filler.prototype.fillAllChannels = function(){
    var obj = asyncCaller[CALLER_INDEX.all_channels].responseObj["data"];

    var channels_container = document.getElementById('allChannelStyle');

    for (var i = 0; i < obj.length; i++){
        var div = document.createElement('div');
        div.setAttribute('class', "row");
        div.setAttribute('id', "side-newss");

        var content = '<div class="col-md-2">' +
                      '<img src="' + obj[i]["channel_img_url"] + '" height="120%" width="120%">'+
                      '</div>' +
                      '<div class="col-md-9">' +
                        '<p><b>' + obj[i]["channel_name"] + '</b></p>'+
                        '<span>' + obj[i]["description"] + '</span>' +
                         '<p><button class="btn btn-primary pull-right" id="sbutton">'+ (user_api_key ? ((obj[i]["isSubscribed"] == 'true') ? 'UNSUBSCRIBE' : 'SUBSCRIBE') : 'LOGIN') + ' | <span id="bold">' + obj[i]["post_count"] + '</span></button></p>' +
                      '</div>';
        div.innerHTML = content;
        channels_container.appendChild(div);

        if (i != (obj.length - 1)){
            channels_container.appendChild(document.createElement('hr'));
        }

    }
};

Filler.prototype.fillCategoryNews = function(){

    var obj = asyncCaller[CALLER_INDEX.category_news].responseObj["data"];

    var category_heading = document.getElementById('channelheading');
    category_heading.innerText = obj[0]["category_name"].toUpperCase();

    var parent = document.getElementById('ccr-latest-post-gallery');

    for (var i = 0; i < obj.length; i++){

        var news_row;

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
                    '<a href="' + utility.getUrlFor("channels/view/" + obj[i]["channel_id"]) + '" id="channelname">' + obj[i]["channel_name"] + '</a>' +
                    '<br><a href="' + utility.getUrlFor("news/view/" + obj[i]["news_id"]) + '" id="link-font">' + utility.shortenText(obj[i]["title"], 50) + '</a>';

        news_item.innerHTML = news;
        news_row.appendChild(news_item);
        parent.appendChild(news_row);
    }

    var container = document.createElement('div');
    container.setAttribute('class', 'container');
    var btn_div = document.createElement('div');
    btn_div.setAttribute('class', 'col-md-9');
    btn_div.innerHTML = '<a href="" class="btn btn-success" id="loadbutton">LOAD MORE</a>';
    container.appendChild(btn_div);
    parent.appendChild(container);

};

Filler.prototype.fillChannelDetails = function(){
    var obj = asyncCaller[CALLER_INDEX.channel].responseObj["data"][0];
    var channel_name = document.getElementById('channelheading');
    var channel_image = document.getElementById('channel_image');
    var channel_desc = document.getElementById('channel_desc');

    channel_name.innerText = obj["channel_name"];
    channel_image.src = obj["channel_img_url"];
    channel_desc.innerText = obj["description"];


};

Filler.prototype.fillChannelNews = function(){

    var obj = asyncCaller[CALLER_INDEX.channel_news].responseObj["data"];

    var parent = document.getElementById('ccr-latest-post-gallery');
    var news_row;
    for (var i = 0; i < obj.length; i++){



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
    }

    var container = document.createElement('div');
    container.setAttribute('class', 'container');
    var btn_div = document.createElement('div');
    btn_div.setAttribute('class', 'col-md-9');
    btn_div.innerHTML = '<a href="" class="btn btn-success" id="loadbutton">LOAD MORE</a>';
    container.appendChild(btn_div);
    parent.appendChild(container);
};

Filler.prototype.fillAllNews = function(){

    var obj = asyncCaller[CALLER_INDEX.all_news].responseObj["data"];
    var limit = 5;
    if (obj.length < 5) limit = obj.length;
    var slider_div = document.getElementById('slider_div');
    var slider_indicators = document.getElementById('slider_indicators');

    var news_parent_div = document.getElementById('sideinfo');
    for (var i = 0; i < limit; i++){
        // fill slider

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

    for (i = limit; i < limit + 5; i++ ){

        index_channels.counts[obj[i]["channel_name"]]++;
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

    getter.getAllNewsWithMarker(obj[i]["news_id"], "older");
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
            channel_container.setAttribute('class', 'container');
            channel_container.innerHTML = '<div class="col-md-9">' +
                                            '<section id="channel_' + obj[i]["channel_id"] + '">' +
                                            '<div class="ccr-gallery-ttile">' +
                                            '<span></span>' +
                                            '<p id="channelheading">' + obj[i]["channel_name"] + '</p>' +
                                            '</div>' +
                                            '</section>' +
                                            '</div>';
            main.appendChild(channel_container);
            channelArray.push(obj[i]["channel_id"]);
        }


        console.log(index_channels.counts);
        parent = document.getElementById('channel_' + obj[i]["channel_id"]);

        if (!index_channels.counts[obj[i]["channel_name"]]){
            index_channels.counts[obj[i]["channel_name"]] = 0;
        }
        if (index_channels.counts[obj[i]["channel_name"]] >= 5){
            continue;
        }

        if ( i % 4 == 0 || i == 0){
            news_row = document.createElement('div');
            news_row.setAttribute('class', 'row');
            news_row.setAttribute('id', 'newsrow');
        }

        index_channels.counts[obj[i]["channel_name"]]++;
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
    }

    getter.getMySubscriptions();
};

Filler.prototype.fillUserNewsFeed = function(){

    var obj = asyncCaller[CALLER_INDEX.all_news].responseObj["data"];

    for (var i = 0; i < obj.length; i++){

    }
};

Filler.prototype.fillUserNewsFeedWithMarker = function(){
    var obj = asyncCaller[CALLER_INDEX.all_news].responseObj["data"];

    for (var i = 0; i < obj.length; i++){

    }
};

Filler.prototype.fillSubscriptions = function(){

    var obj = asyncCaller[CALLER_INDEX.all_news].responseObj["data"];

    var main = document.getElementById('main_content');

    for (var i = 0; i < obj.length; i++){

        if (!index_channels.counts[obj[i]["channel_name"]]) {
            index_channels.counts[obj[i]["channel_name"]] = 0;
        }

        if (!document.getElementById('channel_' + obj[i]["channel_id"])){
            var channel_container = document.createElement('div');
            channel_container.setAttribute('class', 'container');
            channel_container.innerHTML = '<div class="col-md-9">' +
            '<section id="channel_' + obj[i]["channel_id"] + '">' +
            '<div class="ccr-gallery-ttile">' +
            '<span></span>' +
            '<p id="channelheading">' + obj[i]["channel_name"] + '</p>' +
            '</div>' +
            '</section>' +
            '</div>';
            main.appendChild(channel_container);
        }

    }

    //getter.getUserNewsFeed(user_api_key);
};

function sendLoginCredentials(){

    var username_email = document.getElementById('username_email').value;
    var password = document.getElementById('user_password').value;

    asyncCaller[CALLER_INDEX.login]
        .prepareRequest(Method.POST, URL.login, eventCallBack.parseLoginResponse);

    var data = new FormData();
    data.append("username_email", username_email);
    data.append("password", password);

    asyncCaller[CALLER_INDEX.login].makeRequest(data);

}

function setUp(page){
    if (asyncCaller.length == 0){
        console.log(CALLER_INDEX);
        for (var i = 0; i < 15; i++){
            var caller = new AsyncCaller();
            asyncCaller.push(caller);
        }
        console.log(asyncCaller);
    }
    if (!eventCallBack)
        eventCallBack = new EventCallBack();
    if (!getter)
        getter = new Getter();
    if (!filler)
        filler = new Filler();
    if (!utility){
        utility = new Utility();
    }
    fireCalls(page);
}

function fireCalls(page){

    current_page = page;

    // get the side nav loaded
    getter.getCategories();

    var credentials_elt = document.getElementById('cred');
    if (credentials_elt){
        var user_credentials = credentials_elt.innerText.split('_');
        var user_id = user_credentials[1];
        user_api_key = user_credentials[0];
    }

    console.log('USER_API_KEY ' + user_api_key);

    switch (page){
        case PAGE.index:

            if (user_id == 0 || user_api_key == 0){
                // user is not logged in
                getter.getAllNews();
            }
            else{
                // user is logged_in
                getter.getMySubscriptions();
            }
            break;
        case PAGE.login:
            // set onclick listener on the login button
            var login_btn = document.getElementById('login_btn');
            login_btn.onclick = sendLoginCredentials;
            break;
        case PAGE.channels:
            // grasp the channel id from the DOM
            var channelId = document.getElementById('channel_id').innerText;
            getter.getChannelDetails(channelId);
            getter.getChannelNews(channelId);
            break;
        case PAGE.category:
            // grasp the category id from the DOM
            var categoryId = document.getElementById('category_id').innerText;
            getter.getNewsByCategory(categoryId);
            break;
        case PAGE.news:
            // grasp the news id from the DOM
            var newsId = document.getElementById('news_id').innerText;
            // get the specific news details
            getter.getNews(newsId);
            // get the associated comments
            getter.getComment(newsId);
            break;
        case PAGE.all_channels:
            // get all channels
            getter.getAllChannels();
            break;
        default :
            console.log('Unknown Page');
    }

}
