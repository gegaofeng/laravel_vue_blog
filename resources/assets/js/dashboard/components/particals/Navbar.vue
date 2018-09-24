<template>
  <nav class="navbar navbar bg-white shadow">
    <div class="navbar-brand">
      <a class="navbar-toggler text-left" @click="toggle">
        <i class="fas fa-bars text-secondary"></i>
      </a>
    </div>
    <div>
      <button @click="changeLanguage">{{language}}</button>
    </div>
  </nav>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        data(){
            return{
                language:''
            }
        },
        methods: {
            ...mapActions([
                           'toggle'
                       ]),
            changeLanguage:function () {
                let locale = this.$i18n.locale;
                locale === 'zh_cn' ? this.$i18n.locale = 'en' : this.$i18n.locale = 'zh_cn';
                this.language=this.$i18n.locale
                localStorage.setItem('language',this.language)
            }
        },
        mounted(){
            this.language=this.$i18n.locale;
        }
    }
</script>
