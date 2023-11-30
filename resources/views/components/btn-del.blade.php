{{-- コンポーネントはボタンなどの部品を定義してViewで共通部品として実装するための仕組み。ここでは削除ボタン --}}


<form class="button-component" style="display:inline" action="{{ url('reserve-delete/'.$id) }}" method="post">
	@csrf
	@method('DELETE')
	<button type="submit" name="action" class="btn btn-primary" >
	{{ __('Sure') }}
	</button>
</form>