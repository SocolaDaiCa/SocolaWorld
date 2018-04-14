'use strict';
const app = new Vue({
    el: '#app',
    data: {
        input: '',
        output: ''
    },
    methods:{
        filterDuplicate: function() {
            let data = {};
            let inputs = this.input.split('\n');
            inputs.forEach((row) => data[row] = "");
            this.output = Object.keys(data).join("\n");
        },
        randomPassword: function() {
            var length = parseInt(this.input);
            isNaN(length) && (length = 20);
            console.log(length);
            console.log(length);
            this.output = "";
            var possible = 
                'ABCDEFGHIJKLMNOPQRSTUVWXYZ'+
                'abcdefghijklmnopqrstuvwxyz'+
                '0123456789~!@#$%^&*()_+\\`\'/,.<>;:"|[]{}';

            for (var i = 0; i < length; i++){
                let index = Math.floor(Math.random() * possible.length);
                this.output += possible.charAt(index);
            }
        },
        callAPI: function(action) {
            let data = {
                a: action,
                d: this.input
            };
            $.post('', data, (res) => this.output = res);
        }
    }
});