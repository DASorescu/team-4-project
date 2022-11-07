<template>
    <section>
        <div class="separator"></div>
        <div class="container d-flex work">
            <div class="doc-image">
                <img src="../../../../public/img/medico-vertical.svg" alt="">
            </div>
            <div class="description ">

                <h2>Sei un Medico?</h2>
                <p>
                    Iscriviti e raggiungi nuovi pazienti
                    Più di 2 milioni di pazienti cercano ogni mese il loro Medico su iDoctors,
                    il <strong>sito in Italia per visitatori e numero di prenotazioni</strong>.
                </p>
                <h3>Con BDoctors:</h3>
                <ul>
                    <li>Ricevi prenotazioni da <strong>nuovi pazienti</strong></li>
                    <li>Migliori la tua <strong>visibilità e la tua reputazione online</strong></li>
                    <li>Organizzi al meglio il tuo lavoro con una suite completa di <strong>strumenti</strong> dedicati
                        al Medico</li>
                    <li>Puoi usare la nostra <strong>App multipiattaforma</strong> dedicata ai Medici</li>
                    <li>Hai il nostro <strong>staff</strong> sempre <strong>disponibile</strong> ad aiutarti</li>
                </ul>
                <a href="/register" class="btn btn-lg">
                    Inscriviti a BDoctors
                    <font-awesome-icon icon="fa-solid fa-arrow-right " />
                </a>
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
    background: linear-gradient(#7dafff, 5%, #fff);
    padding: 50px 0px;

    .separator {
        height: 100px;
    }

    .doc-image {
        flex-basis: 50%;

        img {
            max-width: 80%;
        }
    }

    .description {
        position: relative;

        p {
            font-size: 17px;
        }

        h2 {
            font-size: 40px;
        }

        h3 {
            font-size: 20px;
        }

        li {
            font-size: 17px;
        }

        .btn {
            opacity: .9;
            position: absolute;
            bottom: 0;
            right: 0;
            color: #fff;
            background-color: #FE9A01;

            &:hover {
                opacity: 1;
                transform: scale(1.03);
            }
        }
    }

    @media screen and (max-width: 576px) {



        .separator {
            height: 50px;
        }

        .work {
            flex-direction: column;
        }

        .doc-image {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;

            img {
                max-width: 50%;

            }
        }

        .description {
            display: flex;
            justify-content: center;
            flex-direction: column;
            position: relative;

            p {
                font-size: 17px;
            }

            h2 {
                font-size: 40px;
            }

            h3 {
                font-size: 20px;
            }

            li {
                font-size: 17px;
            }

            .btn {
                position: static;
                opacity: .9;
                bottom: 0;
                right: 0;
                color: #fff;
                background-color: #FE9A01;
                margin-top: 2rem;

                &:hover {
                    opacity: 1;
                    transform: scale(1.03);
                }
            }
        }
    }


}
</style>






