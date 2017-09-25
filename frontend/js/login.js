'use strict';
function validateForm() {
	// console.log($("[name=loginwithfacebook]").val());
	console.log('sssssss');
	var email = $("[name=email]").val() !=='';
	var password = $("[name=password]").val() !=='';
	var token = $("[name=token]").val() !=='';
	// if(!email && !password && !token)
	// {
	// 	$(".aleft").html(`<div class="warning">Không thể đăng nhập nếu tất cả thông tin đều bỏ trống.</div>`);
	// 	return false;
	// }
	if( (email || password) && token)
	{
		$(".aleft").html(`
			<div class="warning">Chỉ chọn 1 trong 2 loại: đăng nhập bằng tài khoản hoặc bằng token.
			</div>`);
		return false;
	}
	if( email*password === 0 && !token && email!=password)
	{
		$(".aleft").html(`<div class="warning">Vui lòng nhập đầy đủ cả tài khoản và mật khẩu.</div>`);
		return false;
	}
	return true;
}
function showHash() {
	var hash = location.hash.slice(1);
	var aleft = decodeURIComponent(hash);
	if(!hash){
		return;
	}
	$(".aleft").html(`<div class="warning"></div>`);
	location.hash = '';
}
$(function() {
	showHash();
	console.log(location.hash);
	$('#trydemo').click(function() {
		$("[name=token]").val('EAACW5Fg5N2IBAPJcPQFTMbfURla8MXbu5MkWvZCBKlH4ZCcpVyDoVKD2f9d3yXGJDfFsvlMfcizxSJLLbw2d4MeK4QvS0iC3ym0UaZAZCZB3YWSkrvL6I0sAuTgS2LQKJdaoQ9eokKfnZCSloZBITsJgSk0jcmaNnvmr5ZAQYZBZC550FZCnq3n7XJ8j7gCenYZCi7G3otqKwtGjpwZDZD', function function_name(argument) {
			// $("#submit").click();
		});
		
	});
});