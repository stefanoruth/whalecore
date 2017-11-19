module.exports = function(type) {
    this.id = null;
    this.title = null;
    this.type = typeof type !== 'undefined' ? type : null;
    this.fields = [];
    this.dir = 'rows';
    this.description = null;
    this.placeholder = null;
    this.default = null;
    this.required = false;
    this.min = 0;
    this.max = null;
    this.values = [];
}