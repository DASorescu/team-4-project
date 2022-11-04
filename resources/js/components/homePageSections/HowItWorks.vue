<template>
  <section class="text-center d-flex flex-column justify-content-end py-5">
    <h2 class="mb-5">Come Funziona ?</h2>
    <div class="container d-flex align-items-end sm-flex-wrap">
      <div class="feature text-center p-1">
        <img src="../../../../public/img/consultazione-sito.svg" alt="img" />
        <h3>Scegli il Medico</h3>
        <p>
          Fai la scelta migliore secondo le tue esigenze: valuta curriculum, prezzo delle
          prestazioni, patologie trattate e recensioni degli altri pazienti.
        </p>
      </div>
      <div class="feature text-center">
        <img src="../../../../public/img/prenotazione-online.svg" alt="img" />
        <h3>Prenota la visita</h3>
        <p>
          Ti bastano pochi secondi: è facile e veloce, non serve telefonare e non è
          richiesta la carta di credito: pagherai direttamente al medico.
        </p>
      </div>
      <div class="feature text-center">
        <img src="../../../../public/img/medico-e-paziente.svg" alt="img" />
        <h3>Vai all'appuntamento</h3>
        <p>
          Vai dal Medico scelto, nel giorno e nell'ora selezionati. Dopo la visita potrai
          lasciare una tua recensione che sarà utile per gli altri pazienti.
        </p>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  name: "HowItWorks",
};
</script>

<style lang="scss" scoped>
@media (max-width: 560px) {
  .sm-flex-wrap {
    flex-wrap: wrap;
  }
}

section {
  background: linear-gradient(#fff, 90%, #7dafff);

  h2 {
    font-size: 40px;
    margin: 0%;
  }

  div {
    height: 80%;
  }
}

.feature {
  flex-basis: 100% / 3;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;

  img,
  h3,
  p {
    margin-bottom: 10px;
  }

  p {
    margin: 10px auto;
    max-width: 80%;
    font-size: 17px;
  }

  img {
    margin: 10px auto;
    width: 150px;
  }
}
</style>
