'use strict';
var app = new Vue({
    el: '#app',
    data: {
        listUser: []
    },
    method: {},
    created: function() {},
    computed: {

    }
});
$(function() {
    $.getJSON("action/get-data.php", { groupID }, function(listUser) {
        app.listUser = listUser;
        // console.log(listUser);
    });
});
var user;
$(document)
    .on("click", ".button-down", function() {
        user = $(this).parent("div");
        let userID = $(user).attr("data-id");
        $.get("action/done.php", { userID, groupID }, function(res) {
            console.log(res);
            if (res !== 'done') {
            	alert("Thao tác không thành công");
                return;
            }
            user.slideToggle(function() {
                $(this).appendTo("#queue").slideToggle();
            });
        });

    })
    .on("click", ".button-queue", function() {
        user = $(this).parent("div");
        user.slideToggle(function() {
            $(this).appendTo("#queue").slideToggle();
        });
    })
//     .on("click", ".button-save", function() {
//         $(".button-save").text("E gửi ngay ạ.");
//         var order = [];
//         var queue = [];
//         $("#queue div").each(function() {
//             queue.push($(this).data("id"));
//         });
//         $("#order div").each(function() {
//             order.push($(this).data("id"));
//         });
//         // console.log(order + queue);
//         $.post("index.php", "save=1&order=" + order + "&queue=" + queue, function(data) {
//             $(".button-save").text(('hack' === data ? "Chỉ admin Tùng đẹp trai mới được lưu order thôi nha chú." : "Em đã lưu ạ."));
//         });
//     });