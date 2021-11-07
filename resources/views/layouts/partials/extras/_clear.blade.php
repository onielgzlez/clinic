{{-- Scrolltop --}}
<a class="clear" onclick="clearCache('{{ route('clearLocale') }}');window.location.reload()">
	<i class="text-dark-50 flaticon-delete-1"></i>
</a>
<style>
	.clear{
	opacity: .5;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 36px;
    height: 36px;
    position: fixed;
    bottom: 40px;
    left: 280px;
    cursor: pointer;
    z-index: 100;
    background-color: #3699ff;
    box-shadow: 0 0.5rem 1.5rem 0.5rem rgb(0 0 0 / 8%);
    transition: color .15s ease,background-color .15s ease,border-color .15s ease,box-shadow .15s ease;
    border-radius: .42rem!important;
	}
</style>