const Tweet = Vue.component('tweet',{
  props: ['authror', 'message'],
  template: '<div class="tweet"><h3>{{authror}}</h3><p>{{message}}</p></div>'
});
