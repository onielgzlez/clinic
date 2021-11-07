require('./bootstrap');
require('alpinejs');
import getLodash from "lodash/get";
import eachRightLodash from "lodash/eachRight";
import replaceLodash from "lodash/replace";


window.translate = function (string, args) {
    let value = getLodash(window.i18n, string);

    eachRightLodash(args, (paramVal, paramKey) => {
        value = replaceLodash(value, `:${paramKey}`, paramVal);
    });
    return value;
}
window.clearCache = function (url) {
    fetch(url)
}
/*
import React from 'react';
import { render } from 'react-dom';
import { createInertiaApp } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props }) {
        return render(<App {...props} />, el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
*/