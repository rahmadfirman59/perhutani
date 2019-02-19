/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*==============MENU===================*/
$(document).ready(function () {
    "use strict";

    $('ul.navi-level-1 li').hover
            (
                    function ()
                    {
                        $(this).children('ul.navi-level-2').addClass("open-navi-2 animated fadeInUp");
                    },
                    function ()
                    {
                        $(this).children('ul.navi-level-2').removeClass("open-navi-2 animated fadeInUp");
                    }
            );

    $('.has-sub').click(function () {
        $(this).children('ul.navi-level-2').toggleClass("open-navi-2 animated");
        return false;
    });
});
/*==============END MENU===================*/

/*==============HEADER FIXED===================*/
var elementPosition = $('#page-header').offset();

$(window).scroll(function () {
    if ($(window).scrollTop() > elementPosition.top) {
        $('#page-header').addClass("header-fixed");
    } else {
        $('#page-header').removeClass("header-fixed");
    }
});
/*==================END HEADER FIXED===============*/

/*==============BACK TO TOP===============*/
var offset = 450;
var duration = 500;
$(window).on('scroll', function () {
    if ($(this).scrollTop() > offset) {
        $('#to-the-top').fadeIn(duration);
    } else {
        $('#to-the-top').fadeOut(duration);
    }
});

$('#to-the-top').on('click', function (event) {
    event.preventDefault();
    $('html, body').animate({scrollTop: 0}, duration);
    return false;
});
/*==============END BACK TO TOP=============*/

/*===============SEARCH=================*/
$('.btn-search-navi').click(function ()
{
    $('.search-popup').toggleClass("open-search-input animated fadeInUp");
    $('.btn-search-navi .fa-search').toggleClass("fa-remove");
    $('.btn-search-navi').toggleClass("active");
    return false;
});
/*===============END SEARCH==============*/

$('#menu-mobile').click(function ()
{
    $('.navi').toggleClass("navi-open fadeInUp");
    return false;
});

