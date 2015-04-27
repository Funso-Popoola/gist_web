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

        var hour = parseInt(timeArr[0]);
        var minute = parseInt(timeArr[1]);
        var second = parseInt(timeArr[2]);

        // get current date
        date = new Date();
        var current_day = date.getDate();
        var current_month = date.getMonth();
        var current_year = date.getFullYear();

        var current_hour = date.getHours();
        var current_min = date.getMinutes();
        var current_sec = date.getSeconds();

        var year = parseInt(dateArr[0]);
        var month = parseInt(dateArr[1]);
        var day = parseInt(dateArr[2]);

        if (year < current_year){
            var diff = current_year - year;
            return diff + ' year' + ((diff > 1) ? 's' : '') + ' ago';
        }
        if (year == current_year){
            if (current_month > month){
                var diff = current_month - month;
                return diff + ' month' + ((diff > 1) ? 's' : '') + ' ago';
            }
            console.log(current_day);
            console.log(day);
            if (current_day > day){
                var diff = current_day - day;
                return diff + ' day' + ((diff > 1) ? 's' : '') + ' ago';
            }
            if (current_hour > hour){
                var diff = current_hour - hour;
                return (current_hour - hour) + ' hour' + ((diff > 1) ? 's' : '') +' ago';
            }
            if (current_min > minute){
                var diff = current_min - minute;
                return (current_min - minute) + ' minute' + ((diff > 1) ? 's' : '') + ' ago';
            }
            if (current_sec > second){
                return (current_sec - second) + ' second' + ((diff > 1) ? 's' : '') + ' ago';
            }
        }

    }
    return false;

};