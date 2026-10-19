<div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
@forelse($divisions as $item)
<a href="{{ route('frontend.programmes.show', $item->slug) }}" class="flex min-h-[235px] flex-col rounded-[12px] bg-white p-6 text-black">
<span class="text-[32px] font-bold text-[#2430ce]">{{ str_pad($item->number, 2, '0', STR_PAD_LEFT) }}</span>
<h3 class="mt-3 text-base font-bold">{{ $item->name }}</h3>
<p class="mt-auto flex justify-between gap-3 pt-8 text-xs text-muted">{{ $item->programmes_count }} programmes <span class="text-[#2430ce]" aria-hidden="true">→</span></p></a>
@empty<p>No published divisions yet.</p>@endforelse
</div>