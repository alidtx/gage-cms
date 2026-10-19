<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
const props = defineProps({ kind:String, records:Object, options:Array });
const program=props.kind==='programs', division=props.kind==='divisions';
const title=program?'Programs':division?'Divisions':'Programme Groups';
const fields=program?{title:'Title',division_id:'Division',position:'Position in division',code:'Course code',meta_line:'Summary',duration:'Duration',class_size:'Class size',prerequisite:'Prerequisite',aim:'Aim',description:'Description',participants:'Intended participants',link_url:'Link',link_anchor:'Link anchor'}:{name:'Name',slug:'Slug',...(division?{programme_group_id:'Programme group',number:'Division number',description:'Description',detail_url:'Detail link',cta_heading:'CTA heading',cta_body:'CTA description'}:{})};
const defaults=Object.fromEntries(Object.keys(fields).map(k=>[k,['position','number'].includes(k)?1:'']));
Object.assign(defaults,{sort_order:0,...((program||division)?{is_published:true}:{}),...(program?{objectives:[]}: {})});
const form=useForm(defaults), deletion=useForm({}), editing=ref(null);
const longFields=['aim','description','participants','cta_body'];
const required=['title','name','slug','division_id','programme_group_id','position','number'];
watch(()=>form.name,value=>{if(!editing.value && value!==undefined)form.slug=value.toLowerCase().trim().replace(/[^a-z0-9]+/g,'_').replace(/^_|_$/g,'');});
function reset(){editing.value=null;form.reset();form.clearErrors();}
function edit(record){reset();editing.value=record.id;for(const key of Object.keys(defaults))form[key]=key==='objectives'?record.objectives.map(o=>o.body):(record[key]??defaults[key]);document.getElementById('editor')?.scrollIntoView({behavior:'smooth'});}
function save(){form.submit(editing.value?'put':'post',route('backend.'+props.kind+'.'+(editing.value?'update':'store'),editing.value||undefined),{preserveScroll:true,onSuccess:reset});}
function remove(record){if(!confirm('Delete '+(record.title||record.name)+'?'))return;deletion.delete(route('backend.'+props.kind+'.destroy',record.id),{preserveScroll:true,onSuccess:()=>{if(editing.value===record.id)reset();}});}
function move(index,direction){const values=[...form.objectives], next=index+direction;[values[index],values[next]]=[values[next],values[index]];form.objectives=values;}
</script>
<template>
<AuthenticatedLayout><Head :title="title" /><div class="p-4 md:p-8 space-y-6">
<h1 class="text-xl font-semibold">{{title}}</h1>
<nav class="flex flex-wrap gap-4"><Link v-for="(label,key) in {programs:'Programs',divisions:'Divisions','programme-groups':'Groups','training-enquiries':'Enquiries'}" :key="key" :href="route('backend.'+key+'.index')" class="text-indigo-600">{{label}}</Link></nav>
<form id="editor" @submit.prevent="save" class="bg-white rounded-2xl p-6 space-y-4">
<div class="flex flex-wrap items-center justify-between gap-4">
<h2 class="font-semibold">{{editing?'Edit':'Add'}} {{program?'program':division?'division':'group'}}</h2>
<PrimaryButton type="submit" :disabled="form.processing||deletion.processing">{{form.processing?'Saving…':editing?'Save changes':program?'Save Program':division?'Save Division':'Save Group'}}</PrimaryButton>
</div>
<p v-if="(program||division)&&!options.length" class="text-amber-700">Create a {{program?'division':'programme group'}} first.</p>
<fieldset :disabled="form.processing||deletion.processing" class="grid md:grid-cols-2 gap-4">
<label v-for="(label,key) in fields" :key="key" class="block text-sm" :class="{'md:col-span-2':longFields.includes(key)}">{{label}}{{required.includes(key)?' *':''}}
<select v-if="key.endsWith('_id')" v-model="form[key]" required class="mt-2 w-full rounded-xl border-gray-200"><option disabled value="">Select</option><option v-for="option in options" :key="option.id" :value="option.id">{{option.name}}</option></select>
<textarea v-else-if="longFields.includes(key)" v-model="form[key]" rows="3" class="mt-2 w-full rounded-xl border-gray-200" />
<input v-else v-model="form[key]" :required="required.includes(key)" :type="['position','number'].includes(key)?'number':'text'" min="1" max="65535" maxlength="255" class="mt-2 w-full rounded-xl border-gray-200" />
<InputError :message="form.errors[key]" /></label>
<label>Sort order<input v-model="form.sort_order" required type="number" min="0" max="2147483647" class="mt-2 w-full rounded-xl border-gray-200" /><InputError :message="form.errors.sort_order" /></label>
<label v-if="program||division" class="flex items-center gap-2"><input v-model="form.is_published" type="checkbox" />Published<InputError :message="form.errors.is_published" /></label>
<div v-if="program" class="md:col-span-2 space-y-3"><h3>Training objectives</h3><InputError :message="form.errors.objectives" /><div v-for="(objective,index) in form.objectives" :key="index"><div class="flex gap-2"><input v-model="form.objectives[index]" :aria-label="'Objective '+(index+1)" required maxlength="2000" class="w-full rounded-xl border-gray-200" /><button type="button" :disabled="index===0" aria-label="Move up" @click="move(index,-1)">↑</button><button type="button" :disabled="index===form.objectives.length-1" aria-label="Move down" @click="move(index,1)">↓</button><button type="button" @click="form.objectives.splice(index,1)" class="text-red-600">Remove</button></div><InputError :message="form.errors['objectives.'+index]" /></div><button type="button" :disabled="form.objectives.length>=100" @click="form.objectives.push('')" class="text-indigo-600">+ Add objective</button></div>
</fieldset><div class="flex gap-4"><PrimaryButton type="submit" :disabled="form.processing||deletion.processing">{{form.processing?'Saving…':editing?'Save changes':program?'Save Program':division?'Save Division':'Save Group'}}</PrimaryButton><button v-if="editing" type="button" :disabled="form.processing" @click="reset">Cancel</button></div></form>
<section class="bg-white rounded-2xl p-6"><InputError :message="deletion.errors.delete" /><div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead><tr><th class="p-3">Name / Title</th><th class="p-3">Parent / Divisions</th><th class="p-3">Order</th><th class="p-3">Status</th><th class="p-3">Actions</th></tr></thead><tbody><tr v-for="record in records.data" :key="record.id" class="border-t"><td class="p-3">{{record.title||record.name}}</td><td class="p-3">{{record.division?.name||record.group?.name||record.divisions_count||'—'}}</td><td class="p-3">{{record.sort_order}}</td><td class="p-3">{{record.is_published===undefined?'—':record.is_published?'Published':'Draft'}}</td><td class="p-3"><div class="flex gap-4"><button :disabled="form.processing||deletion.processing" @click="edit(record)" class="text-indigo-600">Edit</button><button :disabled="form.processing||deletion.processing" @click="remove(record)" class="text-red-600">Delete</button></div></td></tr><tr v-if="!records.data.length"><td colspan="5" class="p-6 text-gray-500">No records yet.</td></tr></tbody></table></div><nav class="flex gap-4 mt-4"><Link v-if="records.prev_page_url" :href="records.prev_page_url">Previous</Link><span>Page {{records.current_page}} of {{records.last_page}}</span><Link v-if="records.next_page_url" :href="records.next_page_url">Next</Link></nav></section>
</div></AuthenticatedLayout>
</template>
