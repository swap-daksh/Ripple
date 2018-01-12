/*
 |---------------------------------------------------------------------------------------------
 |		Extent jQuery Object
 |---------------------------------------------------------------------------------------------
 */
$.extend({
    dataTypeDropdown: function () {
        return $().dataTypeDropdown(false);
    }
});

/*
 |---------------------------------------------------------------------------------------------
 |                                  Extent jQuery Functions
 |---------------------------------------------------------------------------------------------
 */
$.fn.extend({
    dataTypeDropdown: function (append = true) {
        var options = dataTypeJson(), optionHTML = "";
        window.optionHTML = "";
        for (var i in options) {
            if (i == 0) {
                $.each(options[i], function (name, display) {
                    window.optionHTML += "<option value='" + name + "' >" + display + "</option>";
                });
            } else {
                $.each(options[i], function (name, object) {
                    name = name.replace(/(\b\w)/gi, function (m) {
                        return m.toUpperCase();
                    });
                    window.optGroup = "<optgroup label=\"" + strReplaceAll(name, '-', ' ') + "\">";
                    $.each(object, function (name, display) {
                        window.optGroup += "<option value=\"" + name + "\">" + display + "</option>";
                    });
                    window.optGroup += "</optgroup>";
                    window.optionHTML += window.optGroup;
                });

            }
        }
        optionHTML = window.optionHTML;
        delete window.optionHTML;
        if (append === true) {
            this.html(optionHTML);
        } else {
            return optionHTML;
        }
    }
});


/*
 |---------------------------------------------------------------------------------------------
 |		Independent Functions
 |---------------------------------------------------------------------------------------------
 */
function dataTypeJson(o = null) {
    var dataTypes = [{
        "int": "INT",
        "varchar": "VARCHAR",
        "text": "TEXT",
        "date": "DATE"
    }, {
        'numeric': {
            "tinyint": "TINYINT",
            "smallint": "SMALLINT",
            "mediumint": "MEDIUMINT",
            "int": "INT",
            "bigint": "BIGINT",
            "decimal": "DECIMAL",
            "float": "FLOAT",
            "double": "DOUBLE",
            "real": "REAL",
            "bit": "BIT",
            "boolean": "BOOLEAN",
            "serial": "SERIAL"
        }
    }, {
        "date-and-time": {
            "date": "DATE",
            "datetime": "DATETIME",
            "timestamp": "TIMESTAMP",
            "time": "TIME",
            "year": "YEAR"
        }
    }, {
        "string": {
            "char": "CHAR",
            "varchar": "VARCHAR",
            "tinytext": "TINYTEXT",
            "text": "TEXT",
            "mediumtext": "MEDIUMTEXT",
            "longtext": "LONGTEXT",
            "binary": "BINARY",
            "varbinary": "VARBINARY",
            "tinyblob": "TINYBLOB",
            "mediumblob": "MEDIUMBLOB",
            "blob": "BLOB",
            "longblob": "LONGBLOB",
            "enum": "ENUM",
            "set": "SET"
        }
    }, {
        "spatial": {
            "geometry": "GEOMETRY",
            "point": "POINT",
            "linestring": "LINESTRING",
            "polygon": "POLYGON",
            "multipoint": "MULTIPOINT",
            "multilinestring": "MULTILINESTRING",
            "multipolygon": "MULTIPOLYGON",
            "geometrycollection": "GEOMETRYCOLLECTION"
        }
    }, {
        "JSON": {
            "json": "JSON"
        }
    }];
    //add datatypes
    dataTypes.push(o);
    return dataTypes;
}
function dataTypeJsonAlt(o = null) {
    var dataTypes = {
        'numeric': {
            "tinyint": "TINYINT",
            "smallint": "SMALLINT",
            "mediumint": "MEDIUMINT",
            "int": "INT",
            "bigint": "BIGINT",
            "decimal": "DECIMAL",
            "float": "FLOAT",
            "double": "DOUBLE",
            "real": "REAL",
            "bit": "BIT",
            "boolean": "BOOLEAN",
            "serial": "SERIAL"
        },
        "date-and-time": {
            "date": "DATE",
            "datetime": "DATETIME",
            "timestamp": "TIMESTAMP",
            "time": "TIME",
            "year": "YEAR"
        },
        "string": {
            "char": "CHAR",
            "varchar": "VARCHAR",
            "tinytext": "TINYTEXT",
            "text": "TEXT",
            "mediumtext": "MEDIUMTEXT",
            "longtext": "LONGTEXT",
            "binary": "BINARY",
            "varbinary": "VARBINARY",
            "tinyblob": "TINYBLOB",
            "mediumblob": "MEDIUMBLOB",
            "blob": "BLOB",
            "longblob": "LONGBLOB",
            "enum": "ENUM",
            "set": "SET"
        },
        "spatial": {
            "geometry": "GEOMETRY",
            "point": "POINT",
            "linestring": "LINESTRING",
            "polygon": "POLYGON",
            "multipoint": "MULTIPOINT",
            "multilinestring": "MULTILINESTRING",
            "multipolygon": "MULTIPOLYGON",
            "geometrycollection": "GEOMETRYCOLLECTION"
        },
        "JSON": {
            "json": "JSON"
        }
    };
    //add datatypes
    dataTypes.push(o);
    return dataTypes;
}

function strReplaceAll(string, Find, Replace) {
    try {
        return string.replace(new RegExp(Find, "gi"), Replace);
    } catch (ex) {
        return string;
    }
}

function initSlimScroll() {
    window.attempt = 1;
    var timeInterval = setInterval(function () {
        var height = {
            contentWrapper: $(window).height() - ($('.navbar').outerHeight() + $('#footer').outerHeight()),
            contentOutlet: $('.content-wrapper').innerHeight(),
            outletContent: $('.content-outlet').prop('scrollHeight')
        };
        $('.side-bar-left').height($('.content-wrapper').outerHeight());
        $('.content-wrapper').css('height', height.contentWrapper + $('#footer').outerHeight());
        $('.content-outlet').css('height', (height.contentWrapper));

        //        console.log(height);
        if (window.attempt > 50) {
            clearTimeout(timeInterval);
        }
        window.attempt++;
    }, 10);

}