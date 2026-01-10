import { useState } from 'react';
import { Plus, Trash2, ShoppingCart, Building } from 'lucide-react';

interface OrderItem {
  id: string;
  name: string;
  reference: string;
  quantity: number;
  unitPrice: number;
}

export default function OrderFormPage() {
  const [supplier, setSupplier] = useState('');
  const [service, setService] = useState('IUT Villetaneuse');
  const [deliveryLocation, setDeliveryLocation] = useState('');
  const [items, setItems] = useState<OrderItem[]>([
    { id: '1', name: '', reference: '', quantity: 1, unitPrice: 0 },
  ]);
  const [notes, setNotes] = useState('');

  const addItem = () => {
    const newItem: OrderItem = {
      id: Date.now().toString(),
      name: '',
      reference: '',
      quantity: 1,
      unitPrice: 0,
    };
    setItems([...items, newItem]);
  };

  const removeItem = (id: string) => {
    if (items.length > 1) {
      setItems(items.filter((item) => item.id !== id));
    }
  };

  const updateItem = (id: string, field: keyof OrderItem, value: string | number) => {
    setItems(
      items.map((item) =>
        item.id === id ? { ...item, [field]: value } : item
      )
    );
  };

  const calculateTotal = () => {
    return items.reduce((sum, item) => sum + item.quantity * item.unitPrice, 0);
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    alert('Commande créée avec succès !');
  };

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-[#1e3a5f] mb-2">Nouvelle Commande</h1>
        <p className="text-gray-600">Faites votre demande de commande</p>
      </div>

      <form onSubmit={handleSubmit} className="max-w-5xl">
        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <h2 className="mb-4">Informations générales</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label className="block text-gray-700 mb-2">
                Fournisseur <span className="text-red-500">*</span>
              </label>
              <div className="relative">
                <Building className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
                <select
                  value={supplier}
                  onChange={(e) => setSupplier(e.target.value)}
                  className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded"
                  required
                >
                  <option value="">Sélectionner un fournisseur</option>
                  <option value="Bureau Plus">Bureau Plus</option>
                  <option value="TechSupply">TechSupply</option>
                  <option value="Office Depot">Office Depot</option>
                  <option value="LabEquip">LabEquip</option>
                </select>
              </div>
            </div>

            <div>
              <label className="block text-gray-700 mb-2">
                Service <span className="text-red-500">*</span>
              </label>
              <input
                type="text"
                value={service}
                onChange={(e) => setService(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded"
                required
              />
            </div>

            <div className="md:col-span-2">
              <label className="block text-gray-700 mb-2">
                Lieu de livraison <span className="text-red-500">*</span>
              </label>
              <input
                type="text"
                value={deliveryLocation}
                onChange={(e) => setDeliveryLocation(e.target.value)}
                placeholder="Ex: Bureau 203, Bâtiment A"
                className="w-full px-4 py-2 border border-gray-300 rounded"
                required
              />
            </div>
          </div>
        </div>

        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <div className="flex items-center justify-between mb-4">
            <h2>Articles</h2>
            <button
              type="button"
              onClick={addItem}
              className="flex items-center gap-2 px-4 py-2 bg-[#1e3a5f] text-white rounded hover:bg-[#2a4a7f] transition-colors"
            >
              <Plus className="w-5 h-5" />
              Ajouter un article
            </button>
          </div>

          <div className="space-y-4">
            {items.map((item, index) => (
              <div
                key={item.id}
                className="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 bg-gray-50 rounded"
              >
                <div className="md:col-span-4">
                  <label className="block text-gray-700 text-sm mb-1">
                    Nom de l'article
                  </label>
                  <input
                    type="text"
                    value={item.name}
                    onChange={(e) => updateItem(item.id, 'name', e.target.value)}
                    placeholder="Ex: Ramette papier A4"
                    className="w-full px-3 py-2 border border-gray-300 rounded text-sm"
                    required
                  />
                </div>

                <div className="md:col-span-3">
                  <label className="block text-gray-700 text-sm mb-1">
                    Référence
                  </label>
                  <input
                    type="text"
                    value={item.reference}
                    onChange={(e) => updateItem(item.id, 'reference', e.target.value)}
                    placeholder="Réf. fournisseur"
                    className="w-full px-3 py-2 border border-gray-300 rounded text-sm"
                  />
                </div>

                <div className="md:col-span-2">
                  <label className="block text-gray-700 text-sm mb-1">
                    Quantité
                  </label>
                  <input
                    type="number"
                    min="1"
                    value={item.quantity}
                    onChange={(e) =>
                      updateItem(item.id, 'quantity', parseInt(e.target.value) || 1)
                    }
                    className="w-full px-3 py-2 border border-gray-300 rounded text-sm"
                    required
                  />
                </div>

                <div className="md:col-span-2">
                  <label className="block text-gray-700 text-sm mb-1">
                    Prix unitaire (€)
                  </label>
                  <input
                    type="number"
                    min="0"
                    step="0.01"
                    value={item.unitPrice}
                    onChange={(e) =>
                      updateItem(item.id, 'unitPrice', parseFloat(e.target.value) || 0)
                    }
                    className="w-full px-3 py-2 border border-gray-300 rounded text-sm"
                    required
                  />
                </div>

                <div className="md:col-span-1 flex items-end">
                  <button
                    type="button"
                    onClick={() => removeItem(item.id)}
                    disabled={items.length === 1}
                    className={`w-full px-3 py-2 rounded transition-colors ${
                      items.length === 1
                        ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                        : 'bg-red-100 text-red-600 hover:bg-red-200'
                    }`}
                  >
                    <Trash2 className="w-5 h-5 mx-auto" />
                  </button>
                </div>
              </div>
            ))}
          </div>

          <div className="mt-6 flex justify-end">
            <div className="bg-blue-50 px-6 py-4 rounded-lg">
              <div className="text-gray-600 mb-1">Total estimé</div>
              <div className="text-[#1e3a5f]">{calculateTotal().toFixed(2)} €</div>
            </div>
          </div>
        </div>

        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <h2 className="mb-4">Notes / Commentaires</h2>
          <textarea
            value={notes}
            onChange={(e) => setNotes(e.target.value)}
            placeholder="Ajoutez des informations complémentaires..."
            className="w-full px-4 py-2 border border-gray-300 rounded h-32 resize-none"
          />
        </div>

        <div className="flex gap-4">
          <button
            type="submit"
            className="flex items-center gap-2 px-6 py-3 bg-[#f5b942] text-[#1e3a5f] rounded hover:bg-[#e5a932] transition-colors"
          >
            <ShoppingCart className="w-5 h-5" />
            Créer la commande
          </button>
          <button
            type="button"
            className="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition-colors"
          >
            Annuler
          </button>
        </div>
      </form>
    </div>
  );
}
