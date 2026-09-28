<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
    modelValue: {
        type: File,
        default: null
    },
    acceptedType: {
        type: String,
        default: 'image/*'
    },
    placeholder: {
        type: String,
        default: 'Upload Image'
    },
    helperText: {
        type: String,
        default: 'Recommended: 1200×630px'
    },
    currentUrl: {
        type: String,
        default: null
    },
    error: {
        type: String,
        default: null
    }
})

const emit = defineEmits(['update:modelValue'])

const fileInput = ref(null)
const localPreviewUrl = ref(null)

/* Prefer local blob, fall back to server URL */
const previewUrl = computed(() => localPreviewUrl.value ?? props.currentUrl ?? null)

/* Clean up the blob if the parent clears the file */
watch(
    () => props.modelValue,
    (val) => {
        if (!val && localPreviewUrl.value) {
            URL.revokeObjectURL(localPreviewUrl.value)
            localPreviewUrl.value = null
            if (fileInput.value) fileInput.value.value = ''
        }
    }
)

function handleFileChange(event) {
    const file = event.target.files[0]

    if (file) {
        if (localPreviewUrl.value) URL.revokeObjectURL(localPreviewUrl.value)
        localPreviewUrl.value = URL.createObjectURL(file)
        emit('update:modelValue', file)
    } else {
        if (localPreviewUrl.value) URL.revokeObjectURL(localPreviewUrl.value)
        localPreviewUrl.value = null
        emit('update:modelValue', null)
    }
}
</script>

<template>
    <div class="flex items-center space-x-4">
        <!-- Thumbnail -->
        <div class="w-32 h-20 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center border-2 border-dashed border-gray-300 shrink-0">
            <img
                v-if="previewUrl"
                :src="previewUrl"
                class="w-full h-full object-cover"
                alt="Preview"
            />
            <i v-else class="fas fa-image text-2xl text-gray-400"></i>
        </div>

        <!-- Upload button + helpers -->
        <div>
            <label class="cursor-pointer px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-300 transition-colors inline-block">
                <i class="fas fa-upload mr-2"></i> {{ placeholder }}
                <input
                    ref="fileInput"
                    type="file"
                    :accept="acceptedType"
                    class="hidden"
                    @change="handleFileChange"
                />
            </label>

            <p class="text-xs text-gray-500 mt-1">{{ helperText }}</p>

            <p v-if="error" class="text-xs text-red-600 mt-1">{{ error }}</p>
        </div>
    </div>
</template>