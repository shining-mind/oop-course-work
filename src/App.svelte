<script>
import Router from 'svelte-spa-router'
import routes from './routes';
</script>
<main>
	<Router {routes} />
</main>
<style lang="scss" global>
	@import "./node_modules/bootstrap/scss/bootstrap-reboot";
	@import "./node_modules/bootstrap/scss/grid";
	@import "./node_modules/bootstrap/scss/tables";
	@import "./node_modules/bootstrap/scss/forms";
	@import "./node_modules/bootstrap/scss/buttons";
	@import "./node_modules/bootstrap/scss/alert";
	@import "./node_modules/bootstrap/scss/pagination";
	@import "./node_modules/bootstrap/scss/utilities/text";
	@import "./node_modules/bootstrap/scss/utilities/flex";
	@import "./node_modules/bootstrap/scss/utilities/float";

    main {
        padding-top: 20px;
	}

	.home-link {
		color: black;
		text-decoration: none !important;
		&:hover {
			color: #333;
		}
	}
</style>