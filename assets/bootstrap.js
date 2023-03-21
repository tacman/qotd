import { startStimulusApp } from '@symfony/stimulus-bridge';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

document.addEventListener("turbo:frame-missing", (event) => {
    if (event.target.dataset.deleteIfMissing) {
        event.target.remove();
        event.preventDefault();
    }
});

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);
