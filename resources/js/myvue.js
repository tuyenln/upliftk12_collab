var app = new Vue({
   el: '#app',
   data: {
      message: 'Hello Vue.js!',
      subject: '',
      show_sections: true,
      show_passages: false
   },
   mounted(){
      console.log('mounted');
   },
   methods: {
      changeSubject: function(e){
         this.show_sections = true;
         this.show_passages = false;
         if(this.subject == '23'){
            this.show_sections = false;
            this.show_passages = true;
         }
      }
   }
});