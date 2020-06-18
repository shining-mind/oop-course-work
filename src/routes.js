
// Components
import Home from './pages/Home.svelte'
import Books from './pages/Books.svelte';
import Readers from './pages/Readers.svelte';
import NotFound from './pages/NotFound.svelte'

const routes = {
    // Exact path
    '/': Home,
    '/books/:page?' : Books,
    '/readers/:page?' : Readers,
    // Catch-all, must be last
    '*': NotFound,
}

export default routes