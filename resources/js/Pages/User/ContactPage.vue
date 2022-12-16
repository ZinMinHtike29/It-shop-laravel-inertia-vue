<template>
    <Head>
        <title>Contact</title>
    </Head>
    <Master currentTab="contact">
        <transition
            enter-active-class="animate__animated animate__fadeIn"
            leave-active-class="animate__animated animate__fadeOut"
        >
            <div class="success" v-if="sendMesSuccess">
                <Vue3Lottie
                    :animationData="sendSuccess"
                    class="successAni"
                ></Vue3Lottie>
            </div>
        </transition>
        <div class="card mt-4 mt-md-3">
            <div class="card-body">
                <div class="text-center my-4">
                    <h3>Have Some Message?</h3>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-1">
                        <Vue3Lottie
                            :animationData="contactAnimation"
                        ></Vue3Lottie>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group mb-3">
                            <label for="" class="mb-2 ms-1 form-label"
                                >Name</label
                            >
                            <input
                                type="text"
                                class="form-control py-2 rounded-pill"
                                placeholder="Enter Your Name ..."
                                v-model="contact.userName"
                            />
                            <small
                                class="text-danger ms-1"
                                v-if="contactValidation.userName"
                                >User Name Is Required !</small
                            >
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2 ms-1 form-label"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="form-control py-2 rounded-pill"
                                placeholder="Enter Your Email ..."
                                v-model="contact.email"
                            />
                            <small
                                class="text-danger ms-1"
                                v-if="contactValidation.email"
                                >Email Is Required !</small
                            >
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2 ms-1 form-label"
                                >Message</label
                            >
                            <textarea
                                placeholder="Enter Message ..."
                                cols="30"
                                rows="7"
                                class="form-control"
                                v-model="contact.message"
                            ></textarea>
                            <small
                                class="text-danger ms-1"
                                v-if="contactValidation.message"
                                >Message Is Required !</small
                            >
                        </div>
                        <div class="my-3 text-end">
                            <button
                                class="btn btn-primary"
                                @click="sendMessage"
                                :disabled="clickStatus"
                            >
                                Send Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../user/contactpage.js"></script>

<style scoped>
.success {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    display: flex;
    z-index: 500;
    justify-content: center;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.384);
}
.successAni {
    max-width: 400px;
}
</style>
