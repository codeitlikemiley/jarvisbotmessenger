angular
    .module("messengerBotApp")
    .directive("channelHref", function () {
        return {
            /**
             * Only match attribute name.
             */
            restrict: "A",

            /**
             * Directive scope.
             */
            scope: {
                channel: "=channelHref"
            },

            /**
             * Bind href to element.
             */
            link: function (scope, element) {
                element.attr(
                    "href",
                    BASE_URL + "/bots/" + scope.channel.bot_id + "/subscriptions/channels/" + scope.channel.id
                );
            }
        }
    });