<script setup>
defineProps({ modelValue: [String, Number], label: String, multiline: Boolean, type: { type: String, default: 'text' } });
defineEmits(['update:modelValue']);
</script>
<template>
    <label class="block text-sm font-medium text-gray-700">
        {{ label }}
        <textarea v-if="multiline" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" rows="3" class="mt-2 w-full border-gray-200 rounded-xl text-sm"></textarea>
        <input v-else :value="modelValue" :type="type" @input="$emit('update:modelValue', $event.target.value)" class="mt-2 w-full border-gray-200 rounded-xl text-sm" />
    </label>
</template>
