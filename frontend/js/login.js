/*function*/
function validateForm() {
	var email = $("[name=email]").val() !=='';
	var password = $("[name=password]").val() !=='';
	var token = $("[name=token]").val() !=='';
	if(!email && !password && !token)
	{
		$(".aleft").html(`<div class="warning">Không thể đăng nhập nếu tất cả thông tin đều bỏ trống.</div>`);
		return false;
	}
	if( (email || password) && token)
	{
		$(".aleft").html(`
			<div class="warning">Chỉ chọn 1 trong 2 loại: đăng nhập bằng tài khoản hoặc bằng token.
			</div>`);
		return false;
	}
	if( email*password === 0 && !token )
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
	$('#trydemo').click(function() {
		$("[name=token]").val('EAACW5Fg5N2IBAP3RlQh6vMgkdWGcoqJxZCJtNTNMyS5lVzGZClYLwe00rjXR8ixSfTGsZClZAtLXbWv0cMsxjpAsMH4noSOx6E2DDFGQXx91Jxp1KoXK4RIR0CgolTzGn8dxHMFcuAntZAPZBcJDkRTyFmbJxbSMm3QotPgJnXCZBfI49QiCZCojlOBrgt3A7N8ZD');
		$("#submit").click();
	});
});