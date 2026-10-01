<script setup>
import { computed, ref } from 'vue';
const props = defineProps({ modelValue: Object, reserved: Array });
const emit = defineEmits(['update:modelValue']);
const adding = ref(false);
const name = ref('');
const type = ref('text');
const error = ref('');
const fields = computed(() => Object.entries(props.modelValue).filter(([key]) => !props.reserved.includes(key)));
function update(key, value) {
    emit('update:modelValue', { ...props.modelValue, [key]: value });
}
function add() {
    const key = name.value.trim();
    if (!/^[a-zA-Z][a-zA-Z0-9_]*$/.test(key)) {
        error.value = 'Start with a letter; use only letters, numbers, and underscores.';
        return;
    }
    if (props.reserved.includes(key) || ['__proto__', 'constructor', 'prototype'].includes(key) || Object.hasOwn(props.modelValue, key)) {
        error.value = 'This field name is already used or reserved.';
        return;
    }
    update(key, type.value === 'number' ? 0 : type.value === 'boolean' ? false : '');
    name.value = '';
    error.value = '';
    adding.value = false;
}
function remove(key) {
    const next = { ...props.modelValue };
    delete next[key];
    emit('update:modelValue', next);
}
</script>
<template>
    <div class="space-y-3 border-t border-gray-200 pt-3">
        <div class="flex justify-between items-center text-sm"><span class="font-medium text-gray-700">Custom fields</span><button type="button" @click="adding = !adding; error = ''" class="text-blue-600">+ Add Field</button></div>
        <div v-for="[key, value] in fields" :key="key" class="flex items-start gap-3">
            <label class="flex-1 min-w-0 text-sm text-gray-700">{{ key }}
                <input v-if="typeof value === 'boolean'" type="checkbox" :checked="value" @change="update(key, $event.target.checked)" class="ml-3 rounded text-blue-600" />
                <input v-else-if="typeof value === 'number'" type="number" step="any" :value="value" @input="update(key, $event.target.value === '' ? 0 : Number($event.target.value))" class="mt-1 w-full rounded-lg border-gray-200 text-sm" />
                <textarea v-else-if="typeof value === 'string' || value === null" :value="value" @input="update(key, $event.target.value)" rows="2" class="mt-1 w-full rounded-lg border-gray-200 text-sm"></textarea>
                <span v-else class="block text-xs text-gray-500 mt-1">Structured value — edit in Raw JSON.</span>
            </label>
            <button type="button" @click="remove(key)" :aria-label="'Remove field ' + key" class="text-red-500 text-sm">Remove</button>
        </div>
        <div v-if="adding" class="rounded-lg bg-blue-50 p-3 space-y-3">
            <label class="block text-sm text-gray-700">Field name<input v-model="name" @keydown.enter.prevent="add" maxlength="100" placeholder="e.g. button_label" class="mt-1 w-full rounded-lg border-gray-200 text-sm" /></label>
            <label class="block text-sm text-gray-700">Type<select v-model="type" class="mt-1 w-full rounded-lg border-gray-200 text-sm"><option value="text">Text</option><option value="number">Number</option><option value="boolean">Yes / No</option></select></label>
            <p v-if="error" role="alert" class="text-sm text-red-600">{{ error }}</p>
            <div class="flex gap-3 text-sm"><button type="button" @click="add" class="rounded-lg bg-blue-600 text-white px-3 py-2">Add Field</button><button type="button" @click="adding = false">Cancel</button></div>
        </div>
    </div>
</template>
