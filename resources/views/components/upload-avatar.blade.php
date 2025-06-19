<div x-data="uploadAvatar()" class="mb-4">
    <label class="block mb-1 font-semibold">Avatar (Gambar)</label>
    <div
        class="flex flex-col items-center justify-center border-2 border-dashed border-orange-400 rounded-lg p-6 bg-orange-50 cursor-pointer hover:bg-orange-100 transition relative"
        @dragover.prevent="drag = true"
        @dragleave.prevent="drag = false"
        @drop.prevent="handleDrop($event)"
        :class="{ 'bg-orange-100 border-orange-500': drag }"
        @click="$refs.input.click()"
    >
        <svg class="w-10 h-10 text-orange-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-8m0 0l-4 4m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
        </svg>
        <span class="text-orange-500 font-semibold">Drag & Drop atau Klik untuk Pilih Gambar</span>
        <input type="file" name="avatar" x-ref="input" class="hidden" accept="image/*" @change="handleFile($event)">
    </div>
    <template x-if="error">
        <div class="text-red-500 text-sm mt-2" x-text="error"></div>
    </template>
    <template x-if="preview">
        <div class="mt-4">
            <img :src="preview" class="w-24 h-24 object-cover rounded-full border">
        </div>
    </template>
    <template x-if="progress > 0 && progress < 100">
        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
            <div class="bg-orange-400 h-2.5 rounded-full" :style="'width: ' + progress + '%'" x-text="progress + '%'" style="transition: width 0.3s;"></div>
        </div>
    </template>
</div>
<script>
function uploadAvatar() {
    return {
        drag: false,
        preview: null,
        error: '',
        progress: 0,
        handleFile(e) {
            this.error = '';
            const file = e.target.files[0];
            this.validateAndPreview(file);
        },
        handleDrop(e) {
            this.drag = false;
            const file = e.dataTransfer.files[0];
            this.$refs.input.files = e.dataTransfer.files;
            this.validateAndPreview(file);
        },
        validateAndPreview(file) {
            if (!file) return;
            const validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                this.error = 'Format gambar harus JPG, JPEG, PNG, atau WEBP';
                this.preview = null;
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                this.error = 'Ukuran gambar maksimal 2MB';
                this.preview = null;
                return;
            }
            this.preview = URL.createObjectURL(file);
            this.simulateProgress();
        },
        simulateProgress() {
            this.progress = 0;
            const interval = setInterval(() => {
                if (this.progress < 100) {
                    this.progress += 10;
                } else {
                    clearInterval(interval);
                }
            }, 30);
        }
    }
}
</script> 