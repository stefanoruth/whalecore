module.exports = function(type) {
    this.id = null;
    this.title = null;
    this.type = typeof type !== 'undefined' ? type : null;
    this.fields = [];
    this.dir = 'rows';
    this.placeholder = null;
    if (typeof type !== 'undefined' && type == 'checkbox') {
        this.default = false;
    } else {
        this.default = null;
    }
    this.required = false;
    this.min = 0;
    this.max = null;
    this.values = [];
}