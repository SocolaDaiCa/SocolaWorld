'use strict';
// var arrFriends = null;

function showPage(index) {
    // console.log(page);
    // (page < 1) && (page = 1);
    var first = (index - 1) * record.perPage;
    var last = Math.min(index * record.perPage, record.total - 1);
    $("#result-listfriends").html('');
    for (var i = first; i <= last; i++) {
        var item = arrFriends[i];
        // var score = item.countLike() + item.countComments() * 3;
        // var linkProfile = (item.getName()).link('https://fb.com/' + item.getId());
        var html = `
			<tr>
				<td></td>
				<td>${item.id}</td>
				<td>${item.like}</td>
				<td>${item.comments}</td>
				<td>${item.score}</td>
			</tr>
		`;
        $("#result-listfriends").append(html);
    }
}

function setActive() {
    let index = page.curent;
    /*shoe menu*/
    var dem = 0;
    var left = index;
    var right = index;
    for (let i = 1; i <= 8; i++) {
        if (left - 1 > 0 && dem < 4) {
            left--;
            dem++;
        }
        if (right + 1 <= page.total && dem < 4) {
            right++;
            dem++;
        }
    }
    console.log(left + "-" + right + "-" + page.total);
    let html = '';
    html += `
    	<li id="first"><a href="#/">First</a></li>
    	<li id="previous"><a href="#/">Previous</a></li>
    `;
    for (let i = left; i <= right; i++) {
        html += `
			<li class="page" page="${i}"><a href="#/">${i}</a></li>
	    `;
    }
    html += `
		<li id="next"><a href="#/">Next</a></li>
		<li id="last"><a href="#/">Last</a></li>
    `;
    $('#list-page').html(html);
    /*set active*/
    $(".page").removeClass("active");
    $(`[page=${index}]`).addClass("active");
}
$(function() {
    /*action click*/
    $("body").on('click','.page', function() {
        // $(".page").removeClass('active');
        // $(this).toggleClass('active');
        var index = parseInt($(this).attr("page"));
        showPage(page.index(index));
        setActive();
    });
    $("body").on('click', '#first', function() {
        showPage(page.first());
        setActive();
    });
    $("body").on('click', '#previous', function() {
        showPage(page.prew());
        setActive();
    });
    $("body").on('click', '#next', function() {
        showPage(page.next());
        setActive();
    });
    $("body").on('click', '#last', function() {
        showPage(page.last());
        setActive();
    });
});