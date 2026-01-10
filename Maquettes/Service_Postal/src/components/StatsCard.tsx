interface StatsCardProps {
  title: string;
  count: number;
  icon: React.ReactNode;
}

export function StatsCard({ title, count, icon }: StatsCardProps) {
  return (
    <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
      <div className="flex justify-between items-start mb-4">
        <h3 className="text-gray-700">{title}</h3>
        {icon}
      </div>
      <p className="text-5xl text-[#1a3a5c]">{count}</p>
    </div>
  );
}
