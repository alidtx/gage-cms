@extends('frontend.layouts.app')
@section('content')
@include('frontend.components.hero', ['hero' => \App\Services\FrontendHero::merge([
 'variant'=>'split','container_class'=>'container pb-24 pt-10','heading_class'=>'mt-6 text-[40px] font-extrabold leading-tight tracking-[-1px] sm:text-[56px]','description_class'=>'mt-6 max-w-[660px] text-lg leading-[1.7] text-white/80','image'=>['src'=>'assets/division-page-0.jpg','alt'=>'Fire brigade trainees practising hose operation under an instructor’s supervision','class'=>'aspect-[1.44] w-full rounded-[16px] object-cover'],'section_class'=>'bg-[#2430ce] text-white','grid_class'=>'grid items-start gap-12 lg:grid-cols-[1.2fr_1fr] lg:gap-24',
 'eyebrow'=>'DIVISION '.str_pad($division->number,2,'0',STR_PAD_LEFT),'heading'=>[['text'=>$division->name]],'description'=>$division->description,
 'breadcrumb'=>['title'=>$division->name,'parents'=>[['label'=>'Our Companies','url'=>route('frontend.home').'#companies'],['label'=>'GAGE Training Institute','url'=>route('frontend.gage-training-instruction')],['label'=>'Programmes','url'=>route('frontend.programmes.index')]]],
], $heroContent)])
<section class="bg-[#f0f1fc] py-12"><div class="container grid gap-8 md:grid-cols-3"><div class="flex items-start gap-4"><span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#dfe1fa] text-2xl text-[#2430ce]" aria-hidden="true">Ⅰ</span><div><h2 class="!mt-0 !text-lg !tracking-normal">{{ $division->programmes->count() }} programmes</h2><p class="mt-2 text-sm leading-6 text-muted">Practical training and team-capability programmes</p></div></div><div class="flex items-start gap-4"><span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#dfe1fa] text-2xl text-[#2430ce]" aria-hidden="true">♧</span><div><h2 class="!mt-0 !text-lg !tracking-normal">For resort, industrial &amp; corporate teams</h2><p class="mt-2 text-sm leading-6 text-muted">Short certifications or full team-capability builds</p></div></div><div class="flex items-start gap-4"><span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#dfe1fa] text-2xl text-[#2430ce]" aria-hidden="true">⌖</span><div><h2 class="!mt-0 !text-lg !tracking-normal">On site, in Malé or online</h2><p class="mt-2 text-sm leading-6 text-muted">Mobile classes, weekend & evening classes, virtual classrooms</p></div></div></div></section>
<section class="section container"><div class="grid items-start gap-12 lg:grid-cols-[2.8fr_1fr] lg:gap-24">
<div><h2 class="!mt-0 !text-[28px] !tracking-[-.5px]">Programmes in this division</h2><div class="division-courses mt-8 border-t border-[#c9cdd3]">
@forelse($division->programmes as $program)
<details data-course="{{ $program->id }}" name="division-course" id="programme-{{ $division->number }}-{{ $program->position }}" class="border-b border-[#c9cdd3] py-6" @if($loop->first) open @endif>
<summary class="flex cursor-pointer list-none items-start gap-5"><h3 class="flex-1 text-lg font-bold leading-7">{{ $division->number }}.{{ $program->position }} {{ $program->title }}</h3><span class="hidden max-w-[200px] shrink-0 pt-1 text-right text-xs leading-5 text-[#9198a1] sm:block">{{ $program->meta_line }}</span><span class="course-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl" aria-hidden="true"></span></summary>
<div class="course-content mt-6">
@if($program->duration || $program->class_size || $program->prerequisite || $program->code)
<dl class="grid gap-x-7 gap-y-4 rounded-xl bg-[#f0f1fc] p-6 text-sm leading-6 sm:grid-cols-[170px_1fr]">
@foreach(['code'=>'Course code','duration'=>'Duration','class_size'=>'Suggested class size','prerequisite'=>'Prerequisite'] as $key=>$label)
@if($program->$key)<dt class="font-bold text-[#2430ce]">{{ $label }}</dt><dd>{{ $program->$key }}</dd>@endif
@endforeach
</dl>
@elseif(!$program->aim && !$program->description && !$program->participants && $program->objectives->isEmpty())
<div class="rounded-xl bg-[#f0f1fc] p-6 text-sm leading-7 text-muted">
@if($program->meta_line)<p class="font-bold text-[#2430ce]">{{ $program->meta_line }}</p>@endif
<p class="mt-2">Contact GAGE Training Institute to confirm course content, availability, delivery options and fees for your team.</p>
</div>
@endif
@foreach(['aim'=>'Aim','description'=>'Description','participants'=>'Participants'] as $key=>$label) @if($program->$key)<div class="mt-7"><h4 class="text-lg font-bold">{{ $label }}</h4><p class="mt-3 whitespace-pre-line text-base leading-7 text-muted">{{ $program->$key }}</p></div>@endif @endforeach
@if($program->objectives->isNotEmpty())<div class="mt-7"><h4 class="text-lg font-bold">Training objectives</h4><ul class="mt-4 space-y-3 text-base leading-7 text-muted">@foreach($program->objectives as $objective)<li class="flex gap-3"><span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#dfe1fa] text-xs font-bold text-[#2430ce]" aria-hidden="true">✓</span>{{ $objective->body }}</li>@endforeach</ul></div>@endif
<a href="#training-enquiry" data-select-course="{{ $program->id }}" class="button mt-7 bg-[#2430ce] text-white">Enquire about this course →</a>
</div></details>
@empty<p class="text-muted">No published programmes in this division yet.</p>@endforelse
</div></div>
<aside id="training-enquiry" class="rounded-[16px] border border-[#dfe2e7] border-t-[6px] border-t-[#2430ce] p-6"><h2 class="!mt-0 !text-[22px] !tracking-normal">Book this training</h2><p class="mt-3 text-sm leading-6 text-muted">Tell us about your team and we’ll confirm dates, delivery and fees.</p>
@if(session('training_success'))<p role="status" class="mt-4 rounded-lg bg-green-50 p-4 text-green-800">{{ session('training_success') }}</p>@endif
@if($errors->any())<div role="alert" class="mt-4 text-red-700">Please check the highlighted fields.</div>@endif
@if($division->programmes->isNotEmpty())
<form method="post" action="{{ route('frontend.programmes.enquire',$division->slug) }}" class="mt-6 space-y-5">@csrf
@foreach(['full_name'=>'Full name','organisation'=>'Organisation','email'=>'Email','phone'=>'Phone'] as $key=>$label)
<div><label for="training-{{ $key }}" class="mb-2 block text-sm font-bold">{{ $label }} *</label><input id="training-{{ $key }}" name="{{ $key }}" type="{{ $key==='email'?'email':($key==='phone'?'tel':'text') }}" value="{{ old($key) }}" maxlength="{{ $key==='phone'?32:255 }}" required class="contact-control">@error($key)<p class="text-sm text-red-700">{{ $message }}</p>@enderror</div>
@endforeach
<div><label for="training-programme" class="mb-2 block text-sm font-bold">Programme *</label><select id="training-programme" name="programme_id" required class="contact-control">@foreach($division->programmes as $program)<option value="{{ $program->id }}" @selected(old('programme_id')==$program->id)>{{ $program->title }}</option>@endforeach</select>@error('programme_id')<p class="text-red-700">{{ $message }}</p>@enderror</div>
<div><label for="training-participants" class="mb-2 block text-sm font-bold">Number of participants</label><input id="training-participants" name="participants" type="number" min="1" max="65535" value="{{ old('participants') }}" class="contact-control">@error('participants')<p class="text-red-700">{{ $message }}</p>@enderror</div>
<div><label for="training-delivery" class="mb-2 block text-sm font-bold">Preferred delivery</label><select id="training-delivery" name="delivery_preference" class="contact-control"><option value="">Select preference</option>@foreach(['on_site'=>'On site at our property','male_weekends'=>'In Malé — weekends & evenings','virtual'=>'Virtual classroom'] as $key=>$label)<option value="{{ $key }}" @selected(old('delivery_preference')===$key)>{{ $label }}</option>@endforeach</select>@error('delivery_preference')<p class="text-red-700">{{ $message }}</p>@enderror</div>
<button type="submit" class="button w-full justify-center bg-[#2430ce] text-white">Send training enquiry</button></form>@endif
<p class="mt-5 text-xs">Or email <a href="mailto:training@gage.com.mv" class="font-bold text-[#2430ce]">training@gage.com.mv</a></p></aside></div>
@if($others->isNotEmpty())<div class="mt-[160px]"><p class="eyebrow text-[#2430ce]"><span></span>EXPLORE MORE</p><h2>Other divisions.</h2><div class="mt-12 grid gap-6 md:grid-cols-3">@foreach($others as $other)<article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><p class="text-xs font-bold text-[#2430ce]">DIVISION {{ $other->number }} · {{ $other->programmes_count }} PROGRAMMES</p><h3 class="mt-5 text-xl font-bold leading-7">{{ $other->name }}</h3><p class="mt-4 text-base leading-7 text-muted">{{ $other->description }}</p><a href="{{ route('frontend.programmes.show',$other->slug) }}" class="mt-auto inline-flex items-center gap-2 pt-7 text-sm font-bold text-[#2430ce]">View division →</a></article>@endforeach</div></div>@endif
<div class="mt-[120px] flex flex-col justify-between gap-9 rounded-[24px] bg-[#2430ce] px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16"><div><h2 class="!mt-0">{{ $division->cta_heading ?: 'Build a capable, confident team.' }}</h2><p class="mt-5 max-w-[740px] text-base leading-7 text-white/70">{{ $division->cta_body ?: 'Train your staff on site at your resort, in Malé on weekends and evenings, or online.' }}</p></div><div class="flex flex-col gap-3 lg:min-w-[320px]"><a href="#training-enquiry" class="button button-light !text-[#2430ce]">Enquire about training<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a><a href="mailto:training@gage.com.mv" class="button button-outline">Email training@gage.com.mv<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a></div></div>
</section>
<script>
(() => {
 const select=document.getElementById('training-programme');
 function openHash(){const course=document.getElementById(location.hash.slice(1));if(course?.matches('details[data-course]')){course.open=true;if(select)select.value=course.dataset.course;course.scrollIntoView({block:'start'});}}
 document.querySelectorAll('[data-select-course]').forEach(link=>link.addEventListener('click',()=>{if(select)select.value=link.dataset.selectCourse;}));
 window.addEventListener('hashchange',openHash);openHash();
})();
</script>
@endsection
