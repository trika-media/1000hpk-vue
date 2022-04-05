<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    target: String,
    title: String,
    template: String,
    route: String,
});

const form = useForm({
    method: "_patch",
    berkas: "",
});

const submit = () => {
    form.post(route(props.route), {
        onSuccess: () => {
            form.reset();
            document.getElementById("close-button").click();
        },
    });
};
</script>

<template>
    <div
        class="modal fade"
        :id="props.target"
        tabindex="-1"
        role="dialog"
        :aria-labelledby="props.target"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" @submit.prevent="submit">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{ props.title }}</h2>

                    <button
                        id="close-button"
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>

                <div class="modal-body">
                    <p>
                        Silahkan pilih berkas excel yang ingin Anda import. Jika
                        belum ada, silahkan unduh template format berikut :
                        <br />

                        <a
                            :href="'/template/excel/' + props.template"
                            class="text-secondary"
                            target="_blank"
                        >
                            <u>Unduh Format</u>
                        </a>
                    </p>
                </div>

                <div class="modal-footer">
                    <div class="input-group">
                        <input
                            class="form-control"
                            id="berkas"
                            type="file"
                            @input="form.berkas = $event.target.files[0]"
                            :class="{ 'is-invalid': form.errors.berkas }"
                        />

                        <div v-if="form.errors.berkas" class="invalid-feedback">
                            {{ form.errors.berkas }}
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-secondary"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Import Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
