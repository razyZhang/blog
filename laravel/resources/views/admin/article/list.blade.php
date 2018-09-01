@extends('layouts.base')

@section('title','文章列表')

@section('head')

@endsection

@section('content')

	@foreach($list as $item)
		<div class="list-card">
			<div class="left">
				<div class="title">{{ $item->title }}</div>
				<div class="info">
					<div class="abstract">{{ $item->abstract }}</div>
					<span class="time">{{ $item->created_at }}</span>
				</div>
				<img src="{{ $item->banner }}">
			</div>
			<div class="right">
				<a href="/scan_article/{{ $item->id }}" class="scan"></a>
				<a href="/edit_article/{{ $item->id }}" class="edit"></a>
				<a attr-url="/delete_article/{{ $item->id }}" class="delete"></a>
			</div>
		</div>
	@endforeach
	<div class="pagenavi">
		<nav aria-label="Page navigation">
		  <ul class="pagination" attr-index='1'>
		    <li>
		      <a href="#" aria-label="Previous" class="prev">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    @php $li = 1; @endphp
		    @while ($li <= $pagenum)
		    <li class="pagenum" attr-index="{{ $li }}"><a href="#">{{ $li }}</a></li>
		    @php $li++; @endphp
		    @endwhile
		    <li>
		      <a href="#" aria-label="Next" class="next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>
	</div>

@endsection

@section('scripts')
<script type="text/javascript">
$(function(){
		var cards = $('#content').children('.list-card');
		var total = $('#content').children('.list-card').toArray().length;
		var limit = 12;
		var pagebox = $('#content').find('.pagination');
		var pagenum = pagebox.children('.pagenum');
		var page_total = Math.ceil(total/limit);
		if (page_total > 1) {
			pagebox.css('display','inline-block');
		}

		loopfadeIn(0,limit);

		pagebox.find('.next').click(function(){
			var current = pagebox.attr('attr-index');
			if (current < page_total) {
				var leftnum = (current-1)*limit;
				var rightnum = leftnum + limit;
				var nleftnum = rightnum;
				var nrightnum = Math.min((current+1)*limit,total);
				cards.slice(leftnum,rightnum).css('display','none');
				loopfadeIn(nleftnum,nrightnum);
				current++;
				pagebox.attr('attr-index',current);
			}
		});

		pagebox.find('.prev').click(function(){
			var current = pagebox.attr('attr-index');
			if (current > 1) {
				var leftnum = (current-1)*limit;
				var rightnum =  Math.min(current*limit,total);
				var nleftnum = (current-2)*limit;
				var nrightnum = leftnum;
				cards.slice(leftnum,rightnum).css('display','none');
				loopfadeIn(nleftnum,nrightnum);
				current--;
				pagebox.attr('attr-index',current);
			}
		});

		for (var i = page_total - 1; i >= 0; i--) {
			pagenum.eq(i).click(function(){
				var index = $(this).attr('attr-index');
				var current = pagebox.attr('attr-index');
				if (current != index) {
					var leftnum = (current-1)*limit;
					var rightnum =  Math.min(current*limit,total);
					cards.slice(leftnum,rightnum).css('display','none');
					current = index;
					var nleftnum = (current-1)*limit;
					var nrightnum = Math.min(current*limit,total);
					loopfadeIn(nleftnum,nrightnum);
					pagebox.attr('attr-index',current);
				}

			});
		}

		function loopfadeIn(c,l){

			function loop(c){
				if (c < l) {
					cards.eq(c).fadeIn(200,function(){
						c++;
						loop(c);
					});
				}
			};
			loop(c);
		}

		function loopfadeOut(c,l){

			function loop(c){
				if (c >= l) {
					cards.eq(c).fadeOut(150,function(){
						c--;
						loop(c);
					});
				}
			};
			loop(c);
		}

		cards.each(function(){
			$(this).find('.delete').click(function(){
				var title = $(this).parents('.list-card').find('.title').text();
				var url = $(this).attr('attr-url');
				var dialog = "确定要删除《"+title+"》么? <span class='yes'> 是 </span>|<span class='no'> 否 </span>"

				$('#warn').slideDown(300,function(){

				 	$(this).append(dialog).find('.yes').click(function(){
						location.href = url;
				 	});

				 	$(this).append(dialog).find('.no').click(function(){
				 		$(this).slideUp(300).unbind('click');
				 	});
				});
			});
		})
	});
</script>
@endsection