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
	@import "./scss/var";
	@import "./node_modules/bootstrap/scss/bootstrap-reboot";
	@import "./node_modules/bootstrap/scss/grid";
	@import "./node_modules/bootstrap/scss/tables";
	@import "./node_modules/bootstrap/scss/forms";
	@import "./node_modules/bootstrap/scss/buttons";
	@import "./node_modules/bootstrap/scss/alert";
	@import "./node_modules/bootstrap/scss/pagination";
	@import "./node_modules/bootstrap/scss/modal";

    main {
        padding-top: $padding;
	}

	.home-link {
		color: $font-color;
		text-decoration: none !important;
		padding: 0 $padding;
		&:hover {
			color: $hover-color;
		}
	}

	footer {
		width: 100%;
		position: fixed;
		bottom: 0;
		padding: $padding 0;
		text-align: right;
	}
</style>