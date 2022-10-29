<template>
    <footer>
        <div class="container">
            <div class="footer-section d-flex justify-content-around aling-items-center">
                <a href="#" class="pages-link">
                    Policy
                </a><a href="#" class="pages-link">
                    Chi Siamo
                </a><a href="#" class="pages-link">
                    Dicono Di Noi
                </a>
            </div>
            <div class="footer-section d-flex justify-content-end align-items-center my-2">
                <img src="../../../../public/img/contatti_dottori.png" alt="">
                <div class="d-flex  align-items-start flex-column p-2">
                    <a href="http://127.0.0.1:8000/register">Sei un Medico?</a>
                    <a href="http://127.0.0.1:8000/register"><strong>Inscriviti ora!</strong></a>
                </div>
            </div>
            <div class="footer-section ">
                <p class="text-center txt-gray">
                    Copyright © 2022 BDoctors(team-4 classe 68),<strong>tutti i diritti riservati</strong> .
                </p>
            </div>
        </div>
    </footer>
</template>


<script>
export default {
    name: 'Footer'
}
</script>

<style lang="scss" scoped>
footer {
    background-color: #F9F9F9;

    .footer-section {
        min-height: 100px;
        border-bottom: 1px solid #dedede;

        a {
            &.pages-link {

                line-height: 100px;
            }

            font-size: 15px;
            text-decoration: none;
        }

        p {
            line-height: 100px;
            color: #999999
        }
    }
}
</style>