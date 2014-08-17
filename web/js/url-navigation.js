define(function () {
    return {
        nextVoluntarioId: function (querystring) {
            if (!querystring) {
                return "";
            }

            var re = /voluntarioId=(\w+)/,
                parts = re.exec(querystring),
                hasId = re.test(querystring),
                voluntarioId = hasId ? Number(parts[1]) : "";


            return querystring.replace(re, "voluntarioId=" + Number(voluntarioId + 1));
        },
        previousVoluntarioId: function (querystring) {
            if (!querystring) {
                return "";
            }

            var re = /voluntarioId=(\w+)/,
                parts = re.exec(querystring),
                hasId = re.test(querystring),
                voluntarioId = hasId ? Number(parts[1]) : "";


            return querystring.replace(re, "voluntarioId=" + Number(voluntarioId - 1));
        }
    };
});
