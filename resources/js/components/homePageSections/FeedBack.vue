<template>
    <section class="container d-flex">
        <div class="about-us d-flex my-5">
            <div>
                <img src="../../../../public/img/commenti_diconodinoi.svg" alt="dinoi">
            </div>
            <div>
                <h2>Cosa dicono di noi</h2>
                <p>
                    Oltre il 99% di pazienti soddisfatti

                    BDoctors è il primo sito in Italia di <strong>prenotazioni</strong> di visite mediche ed esami
                    diagnostici, online
                    <strong>
                        dal 2022
                    </strong>.

                    Crediamo nell'importanza dell'
                    <strong>
                        informazione
                    </strong>
                    e della
                    <strong>
                        trasparenza
                    </strong> per aiutare i pazienti a
                    <strong>
                        scegliere il medico giusto
                    </strong> tra gli oltre 9.000 presenti su iDoctors.

                    Per questo su iDoctors, solo i pazienti che hanno prenotato attraverso il sito e svolto la
                    prestazione
                    possono rilasciare un feedback sul medico: una <strong>garanzia dell'affidabilità</strong> delle
                    <strong>113.553</strong> recensioni che
                    leggi.
                </p>
            </div>
        </div>
        <div class="feed-images d-flex my-5">
            <div class="feed-image">
                <img src="../../../../public/img/trustpilot-reviews.webp" alt="Tp" class="tp">
            </div>
            <div class="feed-image">
                <img src="../../../../public/img/facebook-reviews.png" alt="Fb">
            </div>
            <div class="feed-image">
                <img src="../../../../public/img/altroconsumo_reviews.svg" alt="Ac">
                <p class="txt-gray"><strong>"BDoctors</strong> permette al paziente di avere sempre sotto controllo il
                    proprio appuntamento"</p>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'FeedBack'

}
</script>

<style lang="scss" scoped>
section {


    padding: 50px 0px;
    flex-direction: column;

    .about-us {
        height: 80%;

        div {
            flex-basis: 50%;

            img {
                width: 60%;

            }

            p {
                font-size: 18px;
            }

        }

    }

    .feed-image {
        flex-basis: calc(100% / 3);

        img {
            max-width: 80%;

            &.tp {
                max-width: 50%;
            }
        }

        .txt-gray {
            max-width: 80%;
            color: #999999;
            font-size: 17px;
        }
    }

}
</style>