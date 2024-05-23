<template>
  <div id="form-calculator">
    <form @submit.prevent="evaluateExpression">
      <div>
        <label for="expression">Expression:&nbsp; &nbsp; &nbsp;</label>
        <input type="text" v-model="expression" id="expression" required>
      </div>
      <button type="submit">Evaluate</button>
    </form>
    <div v-if="result !== null">
      <h3>Result: {{ result }}</h3>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      expression: '',
      result: null
    };
  },
  methods: {
    async evaluateExpression() {
      try {
        const response = await axios.get('/evaluate', {
          params: {
            expression: this.expression
          }
        });
        this.result = response.data.result;
      } catch (error) {
        console.error('Error evaluating expression:', error);
        this.result = 'Error';
      }
    }
  }
};
</script>
<style scoped>
div#form-calculator {
    width: 22%;
    margin: auto;
}
input {
    color: #000000;
}
</style>
