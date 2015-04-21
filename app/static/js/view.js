/**
 * Created by root on 3/25/15.
 */

var BASE_URL = "http://webo.oauife.edu.ng/gist/api";
var title, image_url, content;

var asyncCaller, eventCallBack, getter, filler;

var KEY = {
    standard: "5cd84de2d3c90164b343708e701963e8",
    admin: "3aa2a3173c895a4618a15e4960bed678"
};

var URL = {
    news: BASE_URL + "/news/category/_ID?" + KEY.standard
};

var EventCallBack = function(){};

EventCallBack.prototype.parseLogin = function(){

};

EventCallBack.prototype.parseNews = function (){

    if (asyncCaller.xhr.readyState == ResponseState.RESPONSE_COMPLETE && asyncCaller.xhr.responseText != null){
        console.log(asyncCaller.xhr.responseText);
        var textResponse = asyncCaller.xhr.responseText;
        var responseObject = JSON.parse(textResponse);
        console.log(responseObject);
        if (responseObject["data"]){
            image_url = responseObject["data"][0]["image_url"];
            content = responseObject["data"][0]["content"];
            title = responseObject["data"][0]["title"];
            filler.fillNews();
        }

        else
            console.log("No data");

    }
};

EventCallBack.prototype.parseCategories = function(){

};

var Getter = function(){};

Getter.prototype.getNews = function(){
    asyncCaller.prepareRequest(Method.GET, URL.news, eventCallBack.parseNews);
    asyncCaller.makeRequest(null);
};

var Filler = function(){};

Filler.prototype.fillNews = function (){

    var img_element = document.getElementById('news_image');
    var news_title_element = document.getElementById('news_title');
    var news_content_element = document.getElementById('news_content');

    img_element.setAttribute('src', image_url);
    news_title_element.innerText = title;
    news_content_element.innerText = content;
};

function setUp(){
    if (!asyncCaller)
        asyncCaller = new AsyncCaller();
    if (!eventCallBack)
        eventCallBack = new EventCallBack();
    if (!getter)
        getter = new Getter();
    if (!filler)
        filler = new Filler();
    fireCalls();
}

function fireCalls(){
    getter.getNews();
}

window.onload = setUp();