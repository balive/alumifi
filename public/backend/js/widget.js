var XmlFeedGrabber;

XmlFeedGrabber = {
    options: {
        token: '',
    },
    messages: {
        missingToken: "Token is missing",
    },
    setOptions: function (options) {
        if (options.token) {
            this.options.token = options.token;
        }
    },
    validate: function () {
        if (!this.options.token) {
            console.log(this.messages.missingToken);
            alert(this.messages.missingToken);
            return false;
        }
        return true;
    },
    render: function () {
        var token = document.getElementById("thonestWidget").getAttribute("data-token");

        this.setOptions({token: token});

        if(!this.validate()) { return; }

        this.applyCss();

        this.fetch(function(response) {
            var json = JSON.parse(response);

            var baseUrl = window.location.href;

            if(json.message == 'success'){
                // if (baseUrl.includes(json.domain)) {


                    if(json.button_location == 'right'){
                        document.body.innerHTML  += '<button id="commentBtn" style="padding: 0;  border-color: transparent;  z-index: 999999; box-shadow: 7px 17px 47px 19px #cccccc73; border-top-right-radius: 10px; border-top-left-radius: 10px; border-bottom-left-radius: 0;border-bottom-right-radius: 0;  position: fixed; top: 50%;right: -45px;width: 140px; ' +
                            'height: 40px;cursor: pointer;transform: rotate(-90deg);  color: '+json.button_text_color+'; background: '+json.button_color+' ;" data-toggle="modal" data-target="#dicussionFrameModal">'+json.button_text+' </button>\n';
                    }
                    else if(json.button_location == 'left'){
                        document.body.innerHTML  += '<button id="commentBtn" style="padding: 0; border-color: transparent; z-index: 999999;  box-shadow: 7px 17px 47px 19px #cccccc73; border-top-right-radius: 10px; border-top-left-radius: 10px; border-bottom-left-radius: 0;border-bottom-right-radius: 0;   position: fixed; top: 50%;left: -45px;width: 140px; ' +
                            'height: 40px;cursor: pointer;transform: rotate(90deg);  color: '+json.button_text_color+'; background: '+json.button_color+' ;">'+json.button_text+' </button>\n';
                    }
                    else if(json.button_location == 'bottom-left'){
                        document.body.innerHTML  += '<button id="commentBtn" style="padding: 0; border-color: transparent; z-index: 999999;  box-shadow: 7px 17px 47px 19px #cccccc73; border-top-right-radius: 10px; border-top-left-radius: 10px; border-bottom-left-radius: 0;border-bottom-right-radius: 0;   position: fixed; ;bottom:1%;left:10px;width: 140px; ' +
                            'height: 40px;cursor: pointer;;  color: '+json.button_text_color+'; background: '+json.button_color+' ;">'+json.button_text+' </button>\n';
                    }
                    else if(json.button_location == 'bottom-right'){
                        document.body.innerHTML  += '<button id="commentBtn" style="padding: 0; border-color: transparent; z-index:999999;box-shadow: 7px 17px 47px 19px #cccccc73; border-top-right-radius: 10px; border-top-left-radius: 10px; border-bottom-left-radius: 0;border-bottom-right-radius: 0;   position: fixed; ;bottom:1%;right:10px;width: 140px; ' +
                            'height: 40px;cursor: pointer;;  color: '+json.button_text_color+'; background: '+json.button_color+' ;">'+json.button_text+' </button>\n';
                    }

                    document.body.innerHTML  += '<iframe id="dicussionFrame" class="visuallyhidden hidden" src="http://127.0.0.1:8000/widget/'+json.token+'" style="transition: .3s ease-in-out opacity,.3s ease-in-out;border: none;z-index:99999;width: 100%; height: 100%;box-shadow: 2px 13px 14px 9px #cdc3c347;border-radius: 6px;position: fixed; bottom: 0; left:0;right: 0;top: 0;" > </iframe>'

                    var btn = document.getElementById('commentBtn');
                    var pc1 = document.getElementById('dicussionFrame');

                    btn.addEventListener('click', function () {
                        if (pc1.classList.contains('hidden')) {
                            btn.innerHTML = 'Close';
                            pc1.classList.remove('hidden');
                            setTimeout(function () {
                                pc1.classList.remove('visuallyhidden');
                            }, 20);
                        } else {
                            btn.innerHTML = json.button_text;
                            pc1.classList.add('visuallyhidden');
                            pc1.addEventListener('transitionend', function(e) {
                                pc1.classList.add('hidden');
                            }, {
                                capture: false,
                                once: true,
                                passive: false
                            });
                        }

                    }, false);

                    // Create IE + others compatible event handler
                    var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
                    var eventer = window[eventMethod];
                    var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

                    console.log('Skooo!');

                    // Listen to message from child window
                    eventer(messageEvent,function(event) {
                        console.log('parent received message!:  ',event.data);
                        if(event.data === 'close_feedback_overlay'){
                            if (pc1.classList.contains('hidden')) {
                                btn.innerHTML = 'Close';
                                pc1.classList.remove('hidden');
                                setTimeout(function () {
                                    pc1.classList.remove('visuallyhidden');
                                }, 20);
                            } else {
                                btn.innerHTML = json.button_text;
                                pc1.classList.add('visuallyhidden');
                                pc1.addEventListener('transitionend', function(e) {
                                    pc1.classList.add('hidden');
                                }, {
                                    capture: false,
                                    once: true,
                                    passive: false
                                });
                            }
                        }

                    },false);


                // }else {
                //     console.log("This discussion widget belongs to the domain " + json.domain  + ", It can not be rendered here. ");
                //     alert("This discussion widget belongs to the domain " + json.domain  + ", It can not be rendered here. ");
                // }


            }else {
                alert('Invalid Widget Token.');
                console.log('Invalid Widget Token.')
            }
        });
    },
    fetch: function (callback) {
        if (window.XMLHttpRequest) {
            var xhr = new XMLHttpRequest();
        } else {
            var xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === 4 && this.status === 200) {
                callback(this.responseText);
            }
        });
        xhr.open('GET', 'http://127.0.0.1:8000/api/button/'+this.options.token, true);
        xhr.onreadystatechange= function() {
            if (this.readyState!==4) return;
            if (this.status!==200) return; // or whatever error handling you want
        };
        xhr.send();
    },
    applyCss: function () {
        var rules = " " +
            ".hidden {\n" +
            "  display: none !important;\n" +
            "}" +
            ".visuallyhidden {\n" +
            "  opacity: 0 !important;\n" +
            "}" +
            "#dicussionFrame {\n" +
            "                opacity: 1;" +
            "               display:block;\n" +
            "                 transition: all 1s linear;\n" +
            "            }\n" +
            "\n" +
            "            #dicussionFrame.hide {\n" +
            "                display: none;\n" +
            "            }" +
            "   #commentBtn:hover{\n" +
            "               filter: brightness(150%); \n" +
            "            }"+
        "   #commentBtn:focus{\n" +
        "                border:none;" +
        "            }";

        var styleTag = document.createElement('style');
        styleTag.type = 'text/css';
        styleTag.appendChild(document.createTextNode(rules));

        document.head.appendChild(styleTag);
    },
};

window.onload = function() {
    XmlFeedGrabber.render();
}




