
// Components
import Home from './pages/Home.svelte'
import Books from './pages/Books.svelte';
import Readers from './pages/Readers.svelte';
import Loans from './pages/Loans.svelte';
import NotFound from './pages/NotFound.svelte'

const routes = {
    // Exact path
    '/': Home,
    '/books/:page?': Books,
    '/readers/:page?': Readers,
    '/loans/:page?': Loans,
    // Catch-all, must be last
    '*': NotFound,
}

export default routes