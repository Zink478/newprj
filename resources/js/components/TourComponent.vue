<template>
    <div>
        <div class="v-step-1">A DOM element on your page. The second step will pop on this element because its ID is 'v-step-1'.</div>
        <div data-v-step="2">A DOM element on your page. The third and final step will pop on this element because its ID is 'v-step-2'.</div>

        <v-tour name="myTour" :steps="steps"></v-tour>
    </div>
</template>

<script>
// feature is a commentTOP
export default{
    data(){
      return {
          steps: [
              {
                  target: '#stepOne',  // We're using document.querySelector() under the hood
                  header: {
                      title: 'Get Started',
                  },
                  content: `Aici poti adauga <strong>produse </strong>noi`
              },
              {
                  target: '#stepTwo',
                  content: 'Aici poti modifica apartenenta produsului la user'
              },
              {
                  target: '[data-v-step="2"]',
                  content: 'Try it, you\'ll love it!<br>You can put HTML in the steps and completely customize the DOM to suit your needs.',
                  params: {
                      placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                  }
              }
          ]
      }
    },
    mounted:function() {
        this.$tours['myTour'].start()
    }
}
</script>
