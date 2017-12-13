<template>
  <div class="modal" :class="{'is-active':show}">
  <div class="modal-background" @click="close"></div>
  <div class="modal-card" @click.stop>
    <header class="modal-card-head">
        <p class="modal-card-title">
            <slot name="title"></slot>
        </p>
    <button class="delete" aria-label="close" @click="close"></button>
    </header>
    <section class="modal-card-body">
      <slot></slot>
    </section>
    <footer class="modal-card-foot">
        <slot name="footer"></slot>
    </footer>
  </div>
</div>
</template>

<script>
export default {
  props: ["show"],
  mounted() {
    document.addEventListener("keydown", e => {
      if (this.show && e.keyCode == 27) {
        this.close();
      }
    });
  },
  methods: {
    close() {
      this.$emit("close");
    }
  }
};
</script>