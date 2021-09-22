<template>
    <div class="modal-container">
        <div class="modal-content">
            <slot name="content">
                Empty
            </slot>
            <div class="footer">
                <div class="btn btn-danger" style="margin-left: auto" @click="$emit('close')">Close</div>
            </div>
        </div>
    </div>
</template>

<style>
.card {
    height: 60vh;
}
.footer{
    display: flex;
}
.modal-container {
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* Add Animation */
@keyframes animatetop {
    from {top: -300px; opacity: 0}
    to {top: 0; opacity: 1}
}
</style>

<script>
export default {

}
</script>
