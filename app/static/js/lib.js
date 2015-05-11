/**
 * Created by root on 4/15/15.
 *
 * This is a javascript library for
 *  - proper async data pull and push
 *  -
 */

var Method = {
    POST: "post",
    GET: "get",
    PUT: "put",
    DELETE: "delete"
};

var ResponseState = {
    REQUEST_SENT: 1,
    REQUEST_SUCCESSFUL: 2,
    RESPONSE_STARTED: 3,
    RESPONSE_COMPLETE: 4
};

var AsyncCaller = function (){
    this.xhr = new XMLHttpRequest();
    this.responseObj = null;
};

AsyncCaller.prototype.prepareRequest = function (method, url, callBack, wait){
    if (!wait) wait = true;
    this.xhr.onreadystatechange = callBack;
    this.xhr.open(method, url, wait);
};

AsyncCaller.prototype.makeRequest = function (data, onloadstart, onloadend){
    if (!onloadstart) onloadstart = null;
    if (!onloadend) onloadend = null;
    this.xhr.onloadstart = onloadstart;
    this.xhr.onloadend = onloadend;
    this.xhr.send(data);
};


var Utility = function (){};

Utility.prototype.getUrlFor = function(path){
    return "http://localhost/web/" + path;
};

Utility.prototype.getHrefFor = function(path){
    return '../../../web/app/static/' + path;
};

Utility.prototype.shortenText = function(text, max_length){
    var result = text.substring(0,max_length);
    result += (text.length > max_length) ? '...' : '';
    return result;
};

Utility.prototype.getRelativeTime = function(timeString){
    var arr = timeString.split(' ');
    if (arr.length > 1){
        var date = arr[0];
        var time = arr[1];

        var dateArr = date.split('-');
        var timeArr = time.split(':');

        var hour = timeArr[0];
        var minute = timeArr[1];
        var second = timeArr[2];

        var year = dateArr[0];
        var month = dateArr[1];
        var day = dateArr[2];

        return moment(year + '-' + month + '-' + day + 'T' + hour + ':' + minute + ':' + second, ["YYYY", moment.ISO_8601]).startOf("second").fromNow();


    }
    return day + '/' + month + '/' + year;

};