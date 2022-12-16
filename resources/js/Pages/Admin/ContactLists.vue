<template>
    <Head>
        <title>User Contact Lists</title>
    </Head>
    <Master currentTab="contactList">
        <div
            class="d-flex justify-content-center"
            v-if="contacts.data.length == 0"
        >
            <h1 class="alert alert-info">There Is No Contact Here!</h1>
        </div>
        <div class="table-responsive">
            <table
                class="table align-middle mb-0 bg-white my-3"
                v-if="contacts.data.length > 0"
            >
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(contact, index) in contacts.data" :key="index">
                        <td>
                            {{ contact.name }}
                        </td>
                        <td>
                            {{ contact.email }}
                        </td>
                        <td>
                            <SeeMore :userData="contact.comment"></SeeMore>
                        </td>
                        <td>
                            {{ contact.date }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div
            class="d-flex justify-content-end mt-3"
            v-if="contacts.data.length != 0"
        >
            <paginate :links="contacts.links"></paginate>
        </div>
    </Master>
</template>

<script src="../../admin/contactList.js"></script>

<style lang="scss" scoped></style>
