@extends('frontend.layouts.app')
@section('content')
@include('frontend.components.hero', ['hero' => \App\Services\FrontendHero::merge([
 'section_class'=>'bg-[#2430ce] text-white','eyebrow'=>'GAGE TRAINING INSTITUTE','heading'=>[['text'=>'Our programmes.']],
 'description'=>'Practical training across safety, security, professional development and hospitality. Delivered on site, in Malé, or in virtual classrooms.',
 'breadcrumb'=>['title'=>'Programmes','parents'=>[['label'=>'GAGE Training Institute','url'=>route('frontend.gage-training-instruction')]]],
], $heroContent)])
<section class="container section" id="catalogue">
<label for="programme-search" class="sr-only">Search programmes</label><input id="programme-search" type="search" placeholder="Search programmes, e.g. first aid" class="contact-control max-w-[520px]">
<fieldset class="mt-6 flex flex-wrap gap-3"><legend class="sr-only">Filter by programme group</legend>
<div><input class="programme-filter sr-only" id="group-all" type="radio" name="catalogue-group" value="all" checked><label for="group-all" class="programme-chip">All ({{ $groups->sum(fn($group)=>$group->divisions->sum(fn($division)=>$division->programmes->count())) }})</label></div>
@foreach($groups as $group)<div><input class="programme-filter sr-only" id="group-{{ $group->id }}" type="radio" name="catalogue-group" value="{{ $group->id }}"><label for="group-{{ $group->id }}" class="programme-chip"> {{ $group->name }} ({{ $group->divisions->sum(fn($division)=>$division->programmes->count()) }})</label></div>@endforeach
</fieldset><p id="programme-results" class="mt-6 text-sm text-muted" role="status"></p>
<div class="mt-12">
@foreach($groups as $group) @foreach($group->divisions as $division)
<section id="division-{{ $division->number }}" data-programme-division data-group="{{ $group->id }}" class="border-t-2 border-[#2430ce] pb-16 pt-8">
<div class="flex flex-wrap justify-between gap-5"><div><span class="text-[40px] font-bold text-[#2430ce]">{{ str_pad($division->number,2,'0',STR_PAD_LEFT) }}</span><h2 class="!mt-3 !text-[26px]">{{ $division->name }}</h2><p class="mt-3 max-w-[820px] text-sm leading-6 text-muted">{{ $division->description }}</p></div><a href="{{ route('frontend.programmes.show',$division->slug) }}" class="text-sm font-bold text-[#2430ce]">View division →</a></div>
<ul class="mt-7 border-t border-[#c9cdd3]">@foreach($division->programmes as $program)
<li data-programme-row data-search="{{ $program->title }} {{ $program->code }} {{ $division->name }}" class="border-b border-[#c9cdd3]"><a href="{{ route('frontend.programmes.show',$division->slug) }}#programme-{{ $division->number }}-{{ $program->position }}" class="flex items-center gap-5 py-5 text-sm font-bold"><span class="w-10 text-[#2430ce]">{{ $division->number }}.{{ $program->position }}</span><span>{{ $program->title }}</span><span class="ml-auto" aria-hidden="true">→</span></a></li>
@endforeach</ul></section>
@endforeach @endforeach
</div></section>
<script>
(() => {
 const root=document.getElementById('catalogue'), search=document.getElementById('programme-search');
 function filter(){ const group=root.querySelector('input[name="catalogue-group"]:checked').value, term=search.value.trim().toLowerCase(); let count=0;
 root.querySelectorAll('[data-programme-division]').forEach(section=>{let shown=0; section.querySelectorAll('[data-programme-row]').forEach(row=>{const visible=(group==='all'||section.dataset.group===group)&&row.dataset.search.toLowerCase().includes(term);row.hidden=!visible;if(visible)shown++;});section.hidden=shown===0;count+=shown;});
 document.getElementById('programme-results').textContent=count ? count+' programmes found' : 'No programmes match your search.';
 } search.addEventListener('input',filter);root.querySelectorAll('[name="catalogue-group"]').forEach(input=>input.addEventListener('change',filter));filter();
})();
</script>
@endsection
