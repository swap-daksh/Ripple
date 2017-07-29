$.extend({
    previewImage: function (o) {
        var totalFiles = o.ele[0].files.length,
                ele = o.ele[0],
                tmpPath = ele.value,
                ext = tmpPath.substring(tmpPath.lastIndexOf('.') + 1).toLowerCase(),
                imgHolder = o.holder;
        //set Image Container empty
        imgHolder.html('');
        //check file Extension
        if (ext === 'gif' || ext === "png" || ext === "jpg" || ext === "jpeg") {

            //check if File reader is Defined or not
            if (typeof (FileReader) !== "undefined") {
                for (var i = 0; i < totalFiles; i++) {
                    //Documention Link
                    //https://developer.mozilla.org/en-US/docs/Web/API/FileReader
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail",
                            "width": o.width,
                            'height': o.height
                        }).appendTo(imgHolder);
                    };
                    reader.readAsDataURL(ele.files[i]);
                }
            }
        }
    }
});
$.fn.extend({
    previewImage: function (o) {
        var totalFiles = o.ele[0].files.length,
                ele = o.ele[0],
                tmpPath = ele.value,
                ext = tmpPath.substring(tmpPath.lastIndexOf('.') + 1).toLowerCase(),
                imgHolder = o.holder;
        //set Image Container empty
        imgHolder.html('');
        //check file Extension
        if (ext === 'gif' || ext === "png" || ext === "jpg" || ext === "jpeg") {

            //check if File reader is Defined or not
            if (typeof (FileReader) !== "undefined") {
                for (var i = 0; i < totalFiles; i++) {
                    //Documention Link
                    //https://developer.mozilla.org/en-US/docs/Web/API/FileReader
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail",
                            "width": o.width,
                            'height': o.height
                        }).appendTo(imgHolder);
                    };
                    reader.readAsDataURL(ele.files[i]);
                }
            }
        }
    }
});
/*
 * javascript function
 */
function route(route_name, property = null) {
    return property !== null ? window.Laravel.routes[route_name][property] : window.Laravel.routes[route_name];
}

function storageURI(file) {
    return window.Laravel.storageLink(file);
}
function publicURI(file) {
    return window.Laravel.public_url(file);
}
function laravel(property) {
    return window.Laravel[property];
}


function previewImage(o) {
    var totalFiles = o.ele[0].files.length,
            ele = o.ele[0],
            tmpPath = ele.value,
            ext = tmpPath.substring(tmpPath.lastIndexOf('.') + 1).toLowerCase(),
            imgHolder = o.holder;
    //set Image Container empty
    imgHolder.html('');
    //check file Extension
    if (ext === 'gif' || ext === "png" || ext === "jpg" || ext === "jpeg") {

        //check if File reader is Defined or not
        if (typeof (FileReader) !== "undefined") {
            for (var i = 0; i < totalFiles; i++) {
                //Documention Link
                //https://developer.mozilla.org/en-US/docs/Web/API/FileReader
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "img-thumbnail",
                        "width": o.width,
                        'height': o.height
                    }).appendTo(imgHolder);
                };
                reader.readAsDataURL(ele.files[i]);
            }
        }
    }
}



function rateText(star, ele) {
    switch (star) {
        case 1:
            $(ele).text('Hated it');
            break;
        case 2:
            $(ele).text('Didn\'t like it');
            break;
        case 3:
            $(ele).text('Just OK');
            break;
        case 4:
            $(ele).text('Liked it');
            break;
        case 5:
            $(ele).text('Loved it');
            break;
        default:
            $(ele).text('');
            break;
    }
}

function calenderDays(o) {
    $(o.ele).each(function (index, ele) {
        var a = $(this).find('a:first'), date = '', dateString = '', monthDays = 0, selected = '', callback = $(this).parents('ul').attr('data-callback');
        index === 0 ? o.today.date : o.today.date++;
        index === 0 ? selected = 'date_selected' : selected = '';
        monthDays = daysInMonth(o.today.year, o.today.month);
        if (o.today.date > monthDays) {
            o.today.month++;
            o.today.date = 1;
        } else {
            o.today.month;
        }
        date = new Date(o.today.year, o.today.month, o.today.date);
        dateString = o.today.days[date.getDay()] + ' ' + date.getDate() + '/' + (date.getMonth() + 1);
        a.text(dateString);
        a.attr({
            'data-date': date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate(),
            'onClick': 'selectDate(this, ' + callback + ')',
            'class': selected
        });
    });
    $(this).parents('ul').removeAttr('data-callback');
}

function selectDate(ele, callback) {
    $('.days a.date_selected').removeClass('date_selected');
    $(ele).parents('.days').children('a').addClass('date_selected');
//    var a = $(ele).attr('data-date').split('-');

    var a = $(ele).attr('data-date');
    date = new Date(a[2], a[1], a[0]);
//    console.log(date.getDate() + '-' + date.getMonth() + '-' + date.getFullYear());
//    filterClassRequest();
    callback;
}
function prevWeek(ele) {
    var ul = $(ele).parents('ul'), date = ul.children('li:first').children('a').attr('data-date').split('-'), d = '', now = dateObj(new Date());
    if (now.date === parseInt(date[2]) && now.month === parseInt(date[1]) && now.year === parseInt(date[0])) {
    } else {
//        d = dateObj(prevWeekDays(date, (ul.children('li').length - 1)));
        calenderDays({ele: '.days', today: dateObj(prevWeekDays(date, (ul.children('li').length - 1)))});
//        filterClassRequest();
    }
}
function nextWeek(ele) {
    var ul = $(ele).parents('ul'), d = dateObj(ul.children('li:last').children('a').attr('data-date'));
    calenderDays({ele: '.days', today: dateObj(ul.children('li:last').children('a').attr('data-date'))});
//    filterClassRequest();
}

function loader(o) {
    var html = "<div class=\"text-center\" id=\"loader-preview\"><img src=\"" + publicURI(o.img) + "\"></div>";
    $(o.ele).html(html);
}

function previewSelectedDate() {
    var date_selected = $('.date_selected').attr('data-date'),
            days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            d = date_selected.split('-').join(','),
            date = new Date(d),
            month = months[date.getMonth() + 1],
            day = days[date.getDay()],
            date = english_ordinal_suffix(date);
    $('#date_preview').html(day + ', ' + month + ' ' + date);
}

function prevWeekDays(dateArray, length) {
    dateArray[2] = dateArray[2] - length;
    if (dateArray[2] < 0) {
        if ((dateArray[1] - 1) < 0) {
            dateArray[1] = 12;
            dateArray[0]--;
        }
        dateArray[2] = daysInMonth(dateArray[0], (dateArray[1] - 1)) - Math.abs(dateArray[2]);
        dateArray[1]--;
    }
    return dateArray.join('-');
}

function dateObj(argDate) {
    var d = '', nd = '', days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], date = '', M;
    if (arguments.length > 1) {
        d = argDate.split('-').join(',');
//        for (var i = 0; i < arguments.length; i++) {
//            d += arguments[i] + ',';
//        }
        date = new Date(d);
//        date = new Date(d.slice(0, -1));
    } else {
        if (typeof argDate === 'object') {
            date = new Date(argDate);
        } else {
            d = argDate.split('-').join(',');
//            for (var i = 0; i < d.length; i++) {
//                nd += d[i] + ',';
//            }
            date = new Date(d);
//            date = new Date(nd.slice(0, -1));
        }
    }
    if (typeof argDate === 'object') {
        M = date.getMonth();
    } else {
        M = date.getMonth() + 1;
    }
    return {
        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        D: days[date.getDay()],
        day: date.getDay(),
        date: date.getDate(),
        month: M,
        year: date.getFullYear(),
        hours: date.getHours(),
        minutes: date.getMinutes(),
        seconds: date.getSeconds()
    };
}



function daysInMonth(year, month) {
    return new Date(year, parseInt(month) + 1, 0).getDate();
}

function filterClassRequest() {
    loader({ele: '#search-result', img: '/images/clock-loader.gif'});
    previewSelectedDate();
    var city = $('select.city.filter-search-data').val(),
            studios = [],
            amenities = [],
            date = $('.date_selected').attr('data-date'),
            starttime = $('#startTimeRange').val(),
            endtime = $('#endTimeRange').val();
    $('input.studios.filter-search-data[type=checkbox]:checked').each(function (index, ele) {
        studios.push($(this).val());
    });
    $('input.amenities.filter-search-data[type=checkbox]:checked').each(function (index, ele) {
        amenities.push($(this).val());
    });
    var data = {_token: laravel('csrfToken'), search: 'classes', studios: studios, amenities: amenities, city: city, date: date, start: starttime, end: endtime};
//    console.log(data);
    $.post(route('filterRequestClass', 'uri'), data, function (data) {
//        console.log(data);
        var html = '';
        if (data.length) {
            for (var i in data) {
                html += classHTML(data[i]);
            }
        } else {
            html += "<div class='col-md-12 text-center'>";
            html += "<img src=" + publicURI('/images/magnify-question.svg') + " width='60' height='60'>";
            html += "<h3>!Oppsâ€¦ no classes available</h3>";
            html += "<p>Reset your filters or search tomorrow's classes to see more results.</p>";
            html += "</div>";
        }

        $('#search-result').html(html);
    }
    );
}
function filterStudioRequest(map = true) {
    window.map = map;
    loader({ele: '#studio-search-result', img: '/images/clock-loader.gif'});
//    previewSelectedDate();
    var city = $('select.city.filter-search-data').val(),
            studios = [],
            amenities = [];
    $('input.studios.filter-search-data[type=checkbox]:checked').each(function (index, ele) {
        studios.push($(this).val());
    });
    $('input.amenities.filter-search-data[type=checkbox]:checked').each(function (index, ele) {
        amenities.push($(this).val());
    });
    var data = {_token: laravel('csrfToken'), search: 'studios', studios: studios, amenities: amenities, city: city};
    $.post(route('filterRequestStudio', 'uri'), data, function (success) {
        if ($('#view-map button').hasClass('active')) {
            $('#studio-search-result').html('<div id="view-studios-map" style="width:100%; height: 100%"></div>');
            var myStyles = [
                {
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [
                        {visibility: "off"}
                    ]
                }
            ];
            if (success.length) {
                var map = new google.maps.Map(document.getElementById('view-studios-map'), {
                    zoom: 13,
                    center: $.parseJSON(success[0].lat_lng),
                    styles: myStyles,
                    scrollwheel: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP

                });
                var infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(map, 'click', function () {
                    infowindow.close();
                });
                /*==========Add Markers to the map==========*/
                for (var i in success) {
                    var coords = $.parseJSON(success[i].lat_lng);
                    var marker = new google.maps.Marker({
                        position: coords,
                        map: map,
                        label: '',
                        icon: publicURI('/images/map-icon-red.png'),
                        title: success[i].studio
                    });
                    var infoContent = studiosSearchInfoWindow(success[i]);
                    google.maps.event.addListener(marker, 'click', (function (marker, infoContent, infowindow) {
                        return function () {
                            if ($('#studio_map_detail').length) {
                                $('#studio_map_detail').remove();
                                $('#view-studios-map').after(infoContent)
                            } else {
                                $('#view-studios-map').after(infoContent)
                            }
                        };
                    })(marker, infoContent, infowindow));
                }
            } else {
                var Address = {
                    country: $('select.city.filter-search-data option:selected').attr('data-country'),
                    city: $('select.city.filter-search-data option:selected').attr('data-city')
                };
                latLng(Address);
                function latLng(address) {
                    var Location = address.city + ', ' + address.country;
                    console.log(Location);

                    // Initialize the Geocoder
                    var geocoder = new google.maps.Geocoder();
                    if (geocoder) {
                        geocoder.geocode({address: Location}, function (results, status) {
                            console.log(results);
                            if (status === google.maps.GeocoderStatus.OK) {
                                var Result = {lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng()};
                                var map = new google.maps.Map(document.getElementById('view-studios-map'), {
                                    zoom: 15,
                                    center: Result,
                                    styles: myStyles,
                                    scrollwheel: true,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP

                                });
                            }
                        });
                    }
                }
            }

        } else {
            var html = '';
            if (success.length) {
                html += '<div class="main-boxfit">';
                for (var i in success) {
                    html += studioHTML(success[i]);
                }
                html += '</div>';
            } else {
                html += "<div class='col-md-12 text-center'>";
                html += "<img src=" + publicURI('/images/magnify-question.svg') + " width='60' height='60'>";
                html += "<h3>!Oppsâ€¦ no classes available</h3>";
                html += "<p>Reset your filters or search tomorrow's classes to see more results.</p>";
                html += "</div>";
            }
            $('#studio-search-result').html(html);
        }
    });
}


function locationViaAddress(address, latlng = false) {
    var Location = address.join(', ');//, returnLocation, LatLng;
    var returnLocation = {}, LatLng = {};
    // Initialize the Geocoder
    var geocoder = new google.maps.Geocoder();
    if (geocoder) {
        geocoder.geocode({address: Location}, function (results, status) {

            if (status === google.maps.GeocoderStatus.OK) {
                returnLocation.location = results;
                LatLng.latlng = {lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng()};
            }
            return results
        });
        console.log(geocoder);
    }
    if (latlng === true) {
        return LatLng;
    } else {
        return returnLocation;
}
}


function strReplaceAll(string, Find, Replace) {
    try {
        return string.replace(new RegExp(Find, "gi"), Replace);
    } catch (ex) {
        return string;
    }
}




function calculateTime(start, end) {
    start = start.split(':'), end = end.split(':');

    /*
     * Calculate 
     */
    var startTimeMin = parseInt(start[0]) * 60 + parseInt(start[1]), endTimeMin = parseInt(end[0]) * 60 + parseInt(end[1]);
    var diffMinutes = endTimeMin - startTimeMin, Hours = Math.floor(diffMinutes / 60), Minutes = diffMinutes - (Hours * 60);
    var HourText = '0H', MinText = '0M';
    if (Hours < 0)
        Hours = start[0] - Math.abs(Hours);
    if (Hours > 0)
        HourText = Hours + 'H';
    if (Minutes > 0)
        MinText = Minutes + "M";

    return HourText + " " + MinText;
}


function english_ordinal_suffix(dt)
{
    return dt.getDate() + (dt.getDate() % 10 == 1 && dt.getDate() != 11 ? 'st' : (dt.getDate() % 10 == 2 && dt.getDate() != 12 ? 'nd' : (dt.getDate() % 10 == 3 && dt.getDate() != 13 ? 'rd' : 'th')));
}

/*
 * |----------------------------------------------------------------------------------------------
 * |                                HTML Markup Functions Starts
 * |-----------------------------------------------------------------------------------------------
 */


function MarkerMarkup(Studio, object = false) {
    var HTML = '';
    HTML += '<div class="map-content-block" id="map-content-block">';
    HTML += '    <h2>' + Studio.studio + '</h2>';
    HTML += '    <span class="close-map-content"></span>';
    HTML += '        <div class="map_img">';
    HTML += '            <img src="' + storageURI(Studio.banner) + '" width="100%" height="200">';
    HTML += '        </div>';
    HTML += '    <div class="map_schedule">';
    HTML += '        <div class="schedule-block clearfix">';
    for (var i in Studio.classes) {
        if (i < 5) {
            var studioClass = Studio.classes[i];
            HTML += '            <div class="map-left-content">';
//            HTML += '                <h5>Tue, Jul</h5>';
            HTML += '            </div>';
            HTML += '            <div class="map-right-content">';
            HTML += '                <ul class="list-inline">';
            HTML += '                    <li>' + studioClass.start + studioClass.time + '</li>';
            HTML += '                    <li>' + studioClass.title + '</li>';
            HTML += '                </ul>';
            HTML += '            </div>';
        }
    }

    HTML += '        </div>';
    HTML += '    </div>';
    HTML += '    <div class="map-btn">';
    HTML += '        <button class="btn btn-danger">View Plans &amp; Pricing</button>';
    HTML += '    </div>';
    HTML += '</div>';
    return HTML;
}


function studioHTML(o) {
    var HTML = '', studio = o.studio, slug = strReplaceAll(strReplaceAll(strReplaceAll(o.studio, ' ', '-'), '/', ''), '\\', '').toLowerCase(), url = route('WebViewStudio', 'uri');
    var studioURL = strReplaceAll(url, '{slug}/{id}', slug + '/' + o.id);
    HTML += '<div class="boxfit-main cross-fit-text">';
    HTML += '    <div class="boxfit-image"><img src="' + storageURI(o.banner) + '" alt=""></div>';
    HTML += '    <div class="boxfit-text">';
    HTML += '        <div class="boxfit-left">';
    HTML += '            <a href="' + studioURL + '">';
    HTML += '                <h2>' + studio + '</h2>';
    HTML += '            </a>';
    HTML += '            <a target="_blank" href="https://maps.google.com/maps?q=' + o.street + ', ' + o.city_name + ', ' + o.zip + ', ' + o.country + '" style="display: block !important;" title="">';
    HTML += '                ' + o.street + ', ' + o.city_name + ', ' + o.zip + ', ' + o.country_name;
    HTML += '            </a>';
    HTML += '            <p class="dalston-text">' + o.city_name + '</p>';
    HTML += '            <p>' + o.about.slice(0, 150) + '...</p>';
    HTML += '        </div>';
    HTML += '        <div class="boxfit-right"><p>' + o.tags + '</p></div>';
    HTML += '    </div>';
    HTML += '</div>';
    return HTML;
}

function studiosSearchInfoWindow(o) {
    var slug = strReplaceAll(strReplaceAll(strReplaceAll(o.studio, ' ', '-'), '/', ''), '\\', '').toLowerCase();
    var url = route('WebViewStudio', 'uri');
    var studioURL = strReplaceAll(url, '{slug}/{id}', slug + '/' + o.id);
    var HTML = '';
    HTML += '<div class="studio_map_detail" id="studio_map_detail">';
    HTML += '        <a class="studio_map_detail_close"></a>';
    HTML += '        <div class="studio__image">';
    HTML += '            <a href="' + studioURL + '">';
    HTML += '                <img src="' + storageURI(o.banner) + '">';
    HTML += '            </a>';
    HTML += '        </div>';
    HTML += '        <div class="studio_map_detail_content">';
    HTML += '            <h4 class="zeta">';
    HTML += '                <a class="link--stealth inline-block text--ellipsis" href="' + studioURL + '" target="_self">' + o.studio + '</a>';
    HTML += '            </h4>';
    HTML += '            <p>' + o.studio + '</p>';
    HTML += '            <p>';
    HTML += '                <a href="https://maps.google.com/maps?q=' + o.street + ', ' + o.city + ', ' + o.zip + ', ' + o.country + '" target="_blank" class="link--stealth">';
    HTML += '                    ' + o.street + '<br>';
    HTML += '                    ' + o.city + ',';
    HTML += '                    ' + o.zip + '';
    HTML += '                    ' + o.country + ' </a><br>';
    HTML += '            </p>';
    HTML += '            <div class="map-btn">        ';
    HTML += '                <a class="btn btn-danger" href="' + studioURL + '">View schedule </a>';
    HTML += '            </div>';
    HTML += '        </div>';
    HTML += '    </div>';
    return HTML;
}

function classHTML(o) {
    var HTML = '', studio = o.studio, slug = strReplaceAll(strReplaceAll(strReplaceAll(o.title, ' ', '-'), '/', ''), '\\', ''), url = route('WebViewClass', 'uri');
    var classURL = strReplaceAll(url, '{slug}/{id}', slug + '/' + o.id);

    HTML += "<div class=\"class-list\">";
    HTML += "<ul>";
    HTML += "    <li>";
    HTML += "        <a title=\"" + o.start + ' ' + o.time + "\">" + o.start + ' ' + o.time;
    HTML += "            <span>" + calculateTime(o.start, o.end) + "</span>";
    HTML += "        </a>";
    HTML += "    </li>";
    HTML += "    <li>";
    HTML += "        <a href=\"" + classURL + "\" title=\"" + o.title + "\">" + o.title;
    HTML += "            <span>" + studio.studio + "</span>";
    HTML += "        </a>";
    HTML += "    </li>";
    HTML += "     <li>";
    HTML += "         <a href=\"https://maps.google.com/maps?q=" + studio.city_name + "\" title=\"" + studio.city_name + "\"><span>" + studio.city_name + "</span></a>";
    HTML += "     </li>";
    HTML += "    <li>";
    HTML += "         <a href=\"javascript:void(0);\" title=\"Strength Training\"><span>" + studio.amenities + "</span></a>";
    HTML += "    </li>";
    HTML += "    <li class=\"pull-right\">";
    HTML += "       <a href=\"javascript:void(0);\" title=\"Expend\" class=\"expend-class\"><i class=\"fa fa-2x fa-chevron-circle-right\"></i></a>";
    HTML += "    </li>";
    HTML += " </ul>";
    HTML += " <div class=\"class-details\">";
    HTML += "     <div class=\"featured-img\">";
    HTML += "         <a href=\"" + classURL + "\"><img src=\"" + storageURI(o.banner) + "\" title=\"\" alt=\"\" width=\"300\" height=\"225\"></a>";
    HTML += "    </div>";
    HTML += "    <div class=\"class-description\">";
    HTML += "          <p>" + o.about.slice(0, 150) + "...&nbsp;&nbsp;";
    HTML += "          <a href=\"" + classURL.toLowerCase() + "\" title=\"Learn more\">Learn more</a></p>";
    HTML += "          <a target=\"_blank\" href=\"https://maps.google.com/maps?q=" + studio.street + ',' + studio.city_name + ',' + studio.zip + ',' + studio.country_name + "\" style=\"display: block !important;\" title=\"\">" + studio.street + ', ' + studio.city_name + ', ' + studio.zip + "</a>";
    HTML += "         </div>";
    HTML += "      </div>";
    HTML += "    </div>";
    return HTML;
}

function classListHtml(o) {
    var HTML = '';
    HTML += '<tr>';
    HTML += '    <td>';
    HTML += '        <p><a href="http://matpass.com/beta/class/th-101/2">' + o.title + '</a></p>';
    HTML += '        <span>' + o.trainer + '</span>';
    HTML += '    </td>';
    HTML += '    <td>';
    HTML += '        <h3>' + o.start + ' - ' + o.end + ' ' + o.time + '</h3>';
    HTML += '        <span>' + o.view_day + '</span>';
    HTML += '    </td>';
    HTML += '    <td>';
    HTML += '        <h3>' + calculateTime(o.start, o.end) + '</h3>';
    HTML += '    </td>';
    HTML += '    <td>';
    HTML += '        <a class="btn-join" href="javascript:void(0);">join</a>';
    HTML += '    </td>';
    HTML += '</tr>';
    return HTML;
}

/*
 * |----------------------------------------------------------------------------------------------
 * |                                HTML Markup Functions Starts
 * |-----------------------------------------------------------------------------------------------
 */