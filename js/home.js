/**
 * Created by Neimark on 17/03/2016.
 */

$('.carousel').carousel({
    interval: 5000,
    pause: ""
})
var home_prev_scroll = 0;
var home_scroll_busy = false;
var home_timer;
var home_speed;
function home_scroll_down(thevalue){
    home_speed = 1;
    home_timer = setInterval(function()
    {
        if((window.scrollY < (thevalue-50)) && (window.scrollY > 0))
        {
            if(home_speed < 15){home_speed += .1;}
            var moveforward = window.scrollY + home_speed;
            window.scrollTo(0, moveforward);
        }
        else
        {
            clearInterval(home_timer);
            home_scroll_busy = false;
        }
    },1);
}

function home_scroll_up(){
    home_speed = 1;
    home_timer = setInterval(function()
    {
        if(window.scrollY > 0)
        {
            if(home_speed < 15){home_speed += .1;}
            var moveforward = window.scrollY - home_speed;
            window.scrollTo(0, moveforward);
        }
        else
        {
            clearInterval(home_timer);
            home_scroll_busy = false;
        }
    },1);
}

function home_set_panel()
{
    var scrollbar = window.scrollY;
    var sliderheight = document.getElementById('carousel-example-generic').clientHeight;
    if((scrollbar > home_prev_scroll) && !home_scroll_busy && (scrollbar > 0))
    {
        if(scrollbar > 0 && scrollbar < (sliderheight/2)){
            home_scroll_busy = true;
            home_scroll_down(sliderheight);
        }
        home_prev_scroll = scrollbar;
    }
    else if(home_prev_scroll > scrollbar)
    {
        if(scrollbar < (sliderheight - 50) && scrollbar > 0 && !home_scroll_busy){
            home_scroll_busy = true;
            home_scroll_up();
        }
        home_prev_scroll = scrollbar;
    }
}

window.onscroll = function(e)
{
    home_set_panel();
};