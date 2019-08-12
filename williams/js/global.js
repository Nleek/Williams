/*--- These is the global functions for the entire web site. Anything that is on more then one page will be located here, such as adjusting the page height ---*/

// --- Global Functions ---
function get_vars(){                //Captures the height and width of the window.
    width = $(window).width();
    height = $(window).height();
}
function adjustPage(){

    get_vars();

    $(".line-height-center").each(function(){       //Used to accurately center an object in the middle of the parent.

        var parent_height = $(this).parent().height();
        $(this).css({"line-height":parent_height+"px"});

    });

    $(".margin-center").each(function(){

        var parent_height = $(this).parent().height();      //Finds the height of the parent, and centers the object in the center of the parent using margins.
        var this_height = $(this).height();
        var centering_value = (parent_height - this_height)/2;
        $(this).css({"margin-top":centering_value+"px"});

    });

    if (width >= 740) {        //This is to activate the mobile menu. "If width is greater then or equal to-- do this."

        $("header ul").css({'display': 'block'});
        $("header ul li").css({'line-height': '90px'});
        $("nav ul").css({'display': 'block'});
        $("#mobile-menu").data("state", "closed").html("<i class='material-icons'>dehaze</i>").css({"background-color":"","color":""});

    }
    else {

        if ($("#mobile-menu").data("state") == "closed") {      //Displays the data in a mobile fashion.
            $("header ul").css({'display': 'none'});
        }

        $("nav ul").css({'display': 'none'});
        $("nav h3").data("state", "closed");

    }

}

$(document).ready(function() {
    adjustPage();

    $("#mobile-menu").click(function(){
        
        var nav_icon = $(this);
        var state = nav_icon.data("state");
        if(state == "closed"){
            $("header ul").fadeIn(300);
            nav_icon.data("state","open");
            adjustPage();
            nav_icon.html("<i class='material-icons'>close</i>");
            nav_icon.css({"background-color":"#fff","color":"#000"});
        }
        else{
            $("header ul").fadeOut(300);
            nav_icon.data("state","closed");
            nav_icon.html("<i class='material-icons'>dehaze</i>");
            nav_icon.css({"background-color":"","color":""});
        }

    });

    $("#down").click(function(){
        var to_elem = $("#questionSection");
        var offset = to_elem.offset().top;
        offset -= 90;
        $('html, body').stop().animate({'scrollTop': offset+"px"}, 700);
    });

    $("#contact-link").click(function(e){
        e.preventDefault();
        $('html,body').animate({
            scrollTop: $(document).height() + "px"
        },1000);
    });

});

$(window).resize(function() {
    adjustPage();
});

// --- Global plugins ---

(function($){
    // Custom question rotation plugin.
    $.fn.questionrotate = function ( options ) {

        var container = $(this);
        var settings = $.extend({
            order         : "linear",                        //String: Defines the path of the rotate.
            transition    : "fade",                          //String: Defines the transition to use.
            nextClass     : "answerButton",                  //String: What, when clicked, rotates to the next question
            questionClass : "question",                      //String: The class of each question.
            inputClass    : "dynamic-value",                 //String: The class of each input to grab and verify.
            inputPrefixes : ["pc-", "mac-"],                 //List: Text to strip from each input's NAME attribute for stylistic purposes.
            questionId    : "Q",                             //String: What identifies each question in the list of questions.
            endcardId     : "endCard",                       //String: What identifies the ending card that displays the chosen answers.
            endcardClass  : "",                              //String: The class to use for each of the generated cards in the EndCard.
            endcardMutateId: "endCardMutable",               //String: The ID of the element to mutate if mutate classes are found.
            endcardMutateClass: "endCardMutate",             //String: The class to look for to determine if the endcard should be mutable.
            additionalDataClass: "answerOptions",            //String: The class to look for if the answer contains extra data we should know about.
            progress      : true,                            //Boolean: Whether or not to have a progress bar.
            suggestions   : true                             //Boolean: Whether or not to throw suggestions based on the answer a user selected.
        }, options);

        var number_questions = -1;
        var answers = [];

        function setup(){

            if(settings.progress){        //Decide to build a progress bar.

                $("."+settings.questionClass).each(function(){
                    number_questions++;
                    $(this).css("display","none");
                });
                container.prepend("<progress id='qr-progress' class='qr-progress' max='"+number_questions+"' value='0'></progress>");

            }
            $("#"+settings.questionId+"0").stop().fadeIn(400,function(){

                $(this).addClass("qr-active");

            });
            $("#back-button").click(function(){

                var card = $(".qr-active");
                var from = card.data("from");
                var last = $("#"+settings.questionId+from).data("from");
                console.log("From: "+from+" | Last:"+last);
                rotate(from);

            });

        }

        function rotate(toQuestion){
            switch(settings.transition){
                default:
                    $(".qr-active").fadeOut('fast',function(){
                        $(this).removeClass("qr-active");
                        $("."+settings.questionClass).css("display","none");
                        $("#"+settings.questionId+toQuestion).stop().fadeIn(400,function(){

                            $(this).addClass("qr-active");
                            if($(this).data("from") && $(this).data("from") != $(this).attr("id").replace(settings.questionId, "")){

                                $("#back-button").css("display","block");

                            }
                            else{

                                $("#back-button").css("display","none");

                            }

                            var endcard = $(this).find("#"+settings.endcardId);
                            if(endcard.length){

                                endcard.html("");
                                console.log(answers);

                                for(var aid in answers){

                                    var answer = answers[aid];

                                    var html = "<div class='"+settings.endcardClass+" overflow-hidden'>" +
                                    "   <h3>"+answer.name+"</h3>" +
                                    "   <div><h4>" + answer.selected+"</h4><div>";
                                    if(answer.inputs.length){

                                        html += "| ";
                                        for(var iid in answer.inputs){
                                            html += answer.inputs[iid][0]+": "+answer.inputs[iid][1]+" | ";
                                        }

                                    }
                                    html += "</div></div></div>";
                                    endcard.append(html);

                                    if(answer.options.hasOwnProperty("mutate")){

                                        $("#"+settings.endcardMutateId).html(answer.options.mutate);

                                    }

                                }
                                $.getJSON('http://www.freegeoip.net/json/?callback=?', function(data) {

                                    var ip = data.ip;
                                    endcard.parent().find(".material-box-header").html("IP: "+ip);

                                });
                            }

                        });
                    });
                    break;
            }

            if(settings.progress){

                $("#qr-progress").attr("value",Number(toQuestion));

            }

        }

        function beginRotate(){

            var next_question = 0;

            $("."+settings.nextClass).click(function(e){

                var clickedNode = String(e.target.nodeName).toLowerCase();
                if(clickedNode!="label" && clickedNode!="input" && clickedNode!="select" && clickedNode != "a"){

                    var go = true;
                    var answer = {
                        name: "",
                        inputs: [],
                        selected: "",
                        options: {}
                    };

                    var me = $(this);

                    answer.selected = me.find(".material-box-header").find("span").html();
                    answer.name = me.parent().parent().find("h3").html();

                    var inputs = me.find("."+settings.inputClass);
                    if( inputs.length ){

                        inputs.each(function(){
                            var value = $(this).val();
                            $(this).removeClass("form-error");
                            if(String(value).trim() == ""){

                                go = false;
                                $(this).addClass("form-error");

                            }
                            else{

                                var name = $(this).attr("name");
                                for(var ipid in settings.inputPrefixes){

                                    name = name.replace(settings.inputPrefixes[ipid], "");

                                }
                                if(go){

                                    answer.inputs.push([name, value]);

                                }

                            }
                        });

                    }
                    if(me.hasClass(settings.endcardMutateClass)){

                        answer.options["mutate"] = $(this).data("qr-mutate-data");

                    }
                    if(me.hasClass(settings.additionalDataClass)){

                        var optionClass = me.data("option-class");
                        answer.options[optionClass] = me.find("."+optionClass).val();
                        
                    }

                    var clicked_question = $(this).closest("."+settings.questionClass).attr("id");
                    clicked_question = Number(clicked_question.replace(settings.questionId, ""));
                    if(settings.order == "linear" && go){

                        next_question = clicked_question + 1;

                    }
                    else if(settings.order == "next" && go){

                        var clicked_button = $(this);
                        var next = clicked_button.data("qr-next");
                        next = next.replace(settings.questionId, "");
                        next_question = next;

                    }

                    if(go){

                        $("#back-button").data("to", clicked_question);
                        $("#"+settings.questionId+next_question).data("from", clicked_question);

                        if(settings.suggestions && me.data("suggest")){

                               var suggestion_text = me.data("suggest");
                               var suggestionModal = new Modal({

                                   icon: true,
                                   iconText: "info_outline",
                                   iconContainerClass: "padding suggestionIcon",
                                   headerClass:"text-center padding-top",
                                   headerContent: null,
                                   bodyClass:"padding",
                                   bodyContent: "<p id='modal-content'>"+suggestion_text+"</p>",
                                   bodyButtons:[],
                                   onClose: function(){rotate(next_question);}

                               });
                               suggestionModal.open();

                        }
                        else{
                            rotate(next_question);
                        }

                        if(!($(this).data("qr-nosavecontent"))) {

                            var found = false;
                            for(var aid in answers) {

                                var a = answers[aid];
                                var name = a.name;

                                if(name == answer.name) {

                                    answers[aid] = answer;
                                    found = true;

                                }

                            }
                            if(!found){

                                answers.push(answer);

                            }

                        }

                    }

                }

            });

        }

        setup();
        beginRotate();

        return answers;

    };
    // Custom parallax element plugin.
    $.fn.parallax = function( options ){
        var selector = $(this);
        var position = selector.position();
        var settings = $.extend({
            offset:0,        // Integer to set the top position of the element.
            divisor:2.5,     // Integer used to set the ratio of the parallax effect
            class:'parallax' // The class to check for in children, if it doesn't exist, defaults are applied.
        },options);
        function initParallax(){
            if(!selector.hasClass(settings.class)){
                selector.css({
                    "transition":"all 0.05s linear",
                    "-moz-transition":"all 0.05s linear",
                    "-ms-transition":"all 0.05s linear",
                    "-o-transition":"all 0.05s linear",
                    "position":"absolute",
                    "top":settings.offset+"%",
                    "left":"0"
                });
            }
        }
        function updateParallax(){
            var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
            var newTop = ((position.top - scrollPos) / settings.divisor) + 1;
            selector.css({"transform":"translateY("+newTop+"px)"});
            setTimeout(function(){
                cancelAnimationFrame(parallaxAnimationFrame);
            }, 1);
        }
        window.addEventListener('scroll',function(){
            parallaxAnimationFrame = requestAnimationFrame(updateParallax);
        });
        initParallax();
    };
    // Custom Modal Plugin
    // Relies on jQuery, animate.css and my custom cssanimate jQuery plugin.
    function buildModal(){
        // Constructs a new modal from the modal template and configures it based on user settings.

        if(this.settings.debug){
            console.log(this);
        }

        if(this.settings.clone) {
            this.element = $("#modal-template").find(".modal").clone();
        }
        else{
            this.element = $("#modal-template").find(".modal");
        }

        if(this.settings.exitButton){

            this.exitButton = this.element.find(".modal-close-button");
            this.exitButton.removeClass("hidden");
            this.exitButton = this.exitButton[0];

        }
        if(this.settings.overlay){

            this.overlay = this.element.find(".modal-overlay");
            this.overlay.removeClass("hidden");
            this.overlay = this.overlay[0];

        }

        if(this.settings.icon){

            this.element.find(".material-icon-container").addClass(this.settings.iconContainerClass).removeClass("hidden");
            this.element.find(".material-icons").html(this.settings.iconText);

        }

        this.element.find(".modal-header").addClass(this.settings.headerClass);
        if(this.settings.headerContent){
            this.element.find(".modal-header-content").html(this.settings.headerContent);
        }

        var me = this;
        this.element.find(".modal-body").addClass(this.settings.bodyClass);
        if(this.settings.bodyContent){
            this.element.find(".modal-content").html(this.settings.bodyContent);
        }

        if(this.settings.bodyButtons){

            var buttonsContainer = this.element.find(".modal-buttons").removeClass("hidden");

            for(bid in this.settings.bodyButtons){
                var button = this.settings.bodyButtons[bid];
                buttonsContainer.append("<button class='"+button[1]+"' onclick='"+button[2]+"'>"+button[0]+"</button>");
            }

        }

        if(this.settings.clone){
            $("body").append(me.element);
        }
        else{
            me.element.css("display","block");
        }

        me.element.removeClass("hidden");

        setTimeout(function(){
            var elementHeight = $(me.element).find(".modal-container").height();
            var windowHeight = $(window).height();
            var topOffset = (windowHeight / 2) - (elementHeight / 2);
            topOffset = topOffset > 0 ? topOffset : 0;
            me.element.find(".modal-container").css({"top":topOffset+"px"});

        },0);
        $(window).resize(function(){
            var elementHeight = $(me.element).find(".modal-container").height();
            var windowHeight = $(window).height();
            var topOffset = (windowHeight / 2) - (elementHeight / 2);
            topOffset = topOffset > 0 ? topOffset : 0;
            me.element.find(".modal-container").css({"top":topOffset+"px"});
        });

        if(this.settings.debug){
            console.log(this);
        }

        return this;

    }
    function bindModalEvents(){
        // Function that binds the exit events to the modal.
        if(this.settings.exitButton){
            this.exitButton.addEventListener('click', this.close.bind(this));
        }
        if(this.settings.overlay && this.settings.exitOverlayOnClick){
            this.overlay.addEventListener('click', this.close.bind(this));
        }

        if(this.settings.debug){
            console.log(this);
        }

        return this;

    }
    function unbindModalEvents() {
        // Function that unbinds the exit events from the modal.
        if (this.exitButton) {
            this.exitButton.removeEventListener('click', this.close.bind(this));
        }
        if (this.settings.overlay && this.settings.exitOverlayOnClick) {
            this.overlay.removeEventListener('click', this.close.bind(this));
        }

        if(this.settings.debug){
            console.log(this);
        }

        return this;

    }

    this.Modal = function(options){
        // Requirements:
        //     - Overlay:                 On/Off
        //     - Exit Button:             On/Off
        //     - Exit on overlay click:   On/Off
        //     - Material Icon Container: On/Off + Class Selection
        //     - Material Icon:           Content Replace
        //     - Header Content:          Content Replace + Class Selection
        //     - Body:                    Class Selection
        //     - Body Content:            Content Replace
        //     - Body Buttons (wrapper):  On/Off + Class Selection
        //     - Body Buttons:            Content Replace + Class Selection + Click Action.
        this.element = null;
        this.exitButton = null;
        this.overlay = null;

        this.settings = $.extend({
            exitButton: true,
            overlay: true,
            exitOverlayOnClick: true,
            inAnimation: "fadeInUp",
            outAnimation: "fadeOutDown",
            animationDuration: 400,
            icon: true,
            iconContainerClass: " circle green-border green-text",
            iconText: "check",
            headerContent: "<h2>Great Work!</h2><p>All Tests Have Passed!</p>",
            headerClass: "",
            bodyClass: "padding highlight",
            bodyContent: null,
            bodyButtons: [["Next Section", "modern-button margin-bottom margin-top transition cursor",function(){}]],
            onOpen: function(){},
            onClose: function(){},
            debug: false,
            clone: true,
        },options);

        return this;

    }
    Modal.prototype.open = function(){

        var me = this;

        buildModal.call(me);
        bindModalEvents.call(me);

        if(me.overlay){
            $(me.overlay).fadeIn(me.settings.animationDuration);
        }
        me.element.find(".modal-container").cssanimate(me.settings.inAnimation,{duration: me.settings.animationDuration});

        me.settings.onOpen.call(me);

    };
    Modal.prototype.close = function(){

        var me = this;

        unbindModalEvents.call(this);
        if(this.overlay){
            $(this.overlay).fadeOut(this.settings.animationDuration);
        }

        me.element.find(".modal-container").cssanimate(this.settings.outAnimation,{duration: this.settings.animationDuration * 2},function(){
            if(me.settings.clone){
                me.element.remove();
            }
            else{
                me.element.css("display","none");
            }
        });

        me.settings.onClose.call(me);

    }
    // Custom CSS animations plugin.
    $.fn.cssanimate = function( effect, options, callback ){

        var element = $(this);
        var settings = $.extend({
            duration: 400,
            hide: true,
            inline: false
        }, options);

        if(typeof callback != "function"){
            callback = function(){};
        }

        function stripAnimationClasses(){
            //This function strips all CSS Animation Classes from the given element.
            var classesToStrip = ["Animated","bounce","flash","pulse","rubberBand","shake","headShake","swing","tada","wobble","jello","bounceIn","bounceInDown","bounceInLeft","bounceInRight","bounceInUp","bounceOut","bounceOutDown","bounceOutLeft","bounceOutRight","bounceOutUp","fadeIn","fadeInDown","fadeInDownBig","fadeInLeft","fadeInLeftBig","fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig","fadeOut","fadeOutDown","fadeOutDownBig","fadeOutLeft","fadeOutLeftBig","fadeOutRight","fadeOutRightBig","fadeOutUp","fadeOutUpBig","flipInX","flipInY","flipOutX","flipOutY","lightSpeedIn","lightSpeedOut","rotateIn","rotateInDownLeft","rotateInDownRight","rotateInUpLeft","rotateInUpRight","rotateOut","rotateOutDownLeft","rotateOutDownRight","rotateOutUpLeft","rotateOutUpRight","hinge","rollIn","rollOut","zoomIn","zoomInDown","zoomInLeft","zoomInRight","zoomInUp","zoomOut","zoomOutDown","zoomOutLeft","zoomOutRight","zoomOutUp","slideInDown","slideInLeft","slideInRight","slideInUp","slideOutDown","slideOutLeft","slideOutRight","slideOutUp"];
            for(i=0;i<=classesToStrip.length;i++){
                if(element.hasClass(classesToStrip[i])){
                    element.removeClass(classesToStrip[i]);
                    console.log("Element '"+element+"' Had the class "+classesToStrip[i]+". It has been removed.");
                }
                else{
                    //console.log("Element '"+element+"' Does not have class "+classesToStrip[i]);
                }
            }
        }

        function addDelays(){
            element.css({
                "-webkit-transition-duration":settings.duration+"ms",
                "transition-duration":settings.duration+"ms"
            });
        }

        stripAnimationClasses();
        addDelays();

        if(settings.hide){
            element.css({"display":"none"});
        }
        if(!settings.inline){
            element.css({"display":"block"});
        }
        else{
            element.css({"display":"inline-block"});
        }
        element.addClass("animated "+effect)

        setTimeout(function(){
            callback();
        },settings.duration);

    }
}(jQuery));