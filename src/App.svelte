<script>
import Router from 'svelte-spa-router'
import routes from './routes';
</script>
<main>
	<Router {routes} />
</main>
<footer>
	<div class="container">
		Icons by <a target="_blank" href="https://icons8.com">Icons8</a>
	</div>
</footer>
<style lang="scss" global>
	@import "./node_modules/bootstrap/scss/bootstrap-reboot";
	@import "./node_modules/bootstrap/scss/grid";
	@import "./node_modules/bootstrap/scss/tables";
	@import "./node_modules/bootstrap/scss/forms";
	@import "./node_modules/bootstrap/scss/buttons";
	@import "./node_modules/bootstrap/scss/alert";
	@import "./node_modules/bootstrap/scss/pagination";
	@import "./node_modules/bootstrap/scss/modal";
	@import "./node_modules/bootstrap/scss/utilities/text";
	@import "./node_modules/bootstrap/scss/utilities/flex";
	@import "./node_modules/bootstrap/scss/utilities/float";

    main {
        padding-top: 20px;
	}

	.home-link {
		color: black;
		text-decoration: none !important;
		padding: 0 15px;
		&:hover {
			color: #333;
		}
	}

	footer {
		width: 100%;
		position: fixed;
		bottom: 0;
		padding: 20px 0;
		text-align: right;
	}
</style>